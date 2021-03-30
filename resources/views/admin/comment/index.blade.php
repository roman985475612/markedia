@extends('admin.layouts.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th style="width: 1%">ID</th>
                    <th style="width: 30%">Текст</th>
                    <th style="width: 15%">Статья</th>
                    <th style="width: 15%">Автор</th>
                    <th style="width: 5%">Статус</th>
                    <th style="width: 15%">Дата создания</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{!! $item->text !!}</td>
                        <td>{{ $item->post->title }}</td>
                        <td>{{ $item->author->name }}</td>
                        <td class="column-status">
                            <i 
                                data-action="status"
                                data-route="{{ route('comments.status', ['comment' => $item->id]) }}" 
                                data-id="{{ $item->id }}"
                                class="fas fa-{{ $item->status ? "check" : "times" }}-circle btn btn-{{ $item->status ? "success" : "danger" }}"
                            ></i>
                        </td>
                        <td>{{ $item->getDate() }}</td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <!--i 
                                    data-action="update"
                                    data-route="{{ route('comments.update', ['comment' => $item->id]) }}" 
                                    data-id="{{ $item->id }}"
                                    data-text="{{ $item->text }}" 
                                    data-post="{{ $item->post }}" 
                                    data-user="{{ $item->user }}" 
                                    class="btn btn-info fas fa-edit"
                                ></i-->
                                <i 
                                    data-action="delete"
                                    data-route="{{ route('comments.destroy', ['comment' => $item->id]) }}" 
                                    data-id="{{ $item->id }}"
                                    class="btn btn-danger fas fa-trash-alt"
                                ></i>
                            </div>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <!--button class="btn btn-success">
            <i 
                data-action="create"
                data-route="{{ route('comments.store') }}" 
                class="fas fa-plus-circle fa-2x"
            ></i>
        </button-->
        {{ $model->links('vendor.pagination.blog-pagination') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
document.querySelector('.card').addEventListener('click', event => {
    event.preventDefault()
    event.stopPropagation()

    if (event.target.dataset.action == 'create') {
        let url = event.target.dataset.route

        fields = [
            {type: 'textarea', name: 'text', placeholder: 'Comment', value: ''}
        ]

        form = getForm(url, 'POST', fields)

        swal({
            title: 'Создание комментария', 
            content: form,
            buttons: true,
        })
        .then(ok => {
            if (ok) {
                form.submit()                
            }
        })
    } else if (event.target.dataset.action == 'update') {
        let id = event.target.dataset.id
        let text = event.target.dataset.text
        let url = event.target.dataset.route

        fields = [
            {type: 'textarea', name: 'text', placeholder: 'Comment', value: text}
        ]

        form = getForm(url, 'POST', fields)

        swal({
            title: 'Обновление комментария', 
            content: form,
            buttons: true,
        })
        .then(ok => {
            if (ok) {
                form.submit()
            }
        })
    } else if (event.target.dataset.action == 'delete') {
        let id = event.target.dataset.id
        let url = event.target.dataset.route

        swal({
            title: 'Уделение комментария', 
            text: 'Вы уверены, что хотите удалить комментарий # ' + id + '?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then(ok => {
            if (ok) {
                getForm(url, 'DELETE').submit()
            }
        })
    } else if (event.target.dataset.action == 'status') {
        let id = event.target.dataset.id
        let url = event.target.dataset.route

        swal({
            title: 'Изменение статуса комментария', 
            text: 'Вы уверены, что хотите изменить статус комментария #' + id + '?',
            icon: 'warning',
            buttons: true,
        })
        .then(ok => {
            if (ok) {
                getForm(url).submit()                
            }
        })
    }
})

function getForm( action , method = 'POST', fields = [] ) {

    let form = document.createElement('form')
    form.action = action
    form.method = ( method == 'GET' ) ? method : 'POST'
    form.insertAdjacentHTML('afterbegin', getTokenField())

    if ( method in ['PUT', 'DELETE'] ) {
        form.insertAdjacentHTML('afterbegin', getMethodField( method ))
    }

    addEditor = false
    fields.forEach( field => {
        switch( field.type ) {
            case 'textarea':
                form.insertAdjacentHTML('beforeEnd', getTextarea( field ))
                addEditor = true
                break
        }
    })

    document.body.append(form)

    if ( addEditor ) {
        ClassicEditor
            .create( document.querySelector( 'textarea' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );
    }

    return form
}

function getTokenField() {
    let csrf_token = document.querySelector('meta[name="csrf-token"]').content
    return '<input type="hidden" name="_token" value="' + csrf_token + '">'
}

function getMethodField( method ) {
    return '<input type="hidden" name="_method" value="' + method + '">'
}

function getInputField( params ) {
    result = '<div class="input-group mb-3"><input '
        + 'type="' + params.type + '" '
        + 'name="' + params.name + '" ' 
        + 'class="' + "form-control" + '" ' 
        + 'placeholder="' + params.placeholder + '"'
    
    if ( params.hasOwnProperty( 'value' )) {
        result += ` value=${params.value}`
    }

    result += '></div>'
    return result
}

function getTextarea( params ) {
    return `<div class="form-group">
    <textarea
        rows="3"
        name="${params.name}" 
        class="form-control" 
        id="description" 
        placeholder="${params.placeholder}"
    >${params.value}</textarea></div>`
}

function getImageForm( thumbnail ) {
    return `<img id="formImg" src="${thumbnail}" class='img-thumbnail mb-3' width="150px">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                <label class="custom-file-label" id="thumbnailLabel" for="thumbnail">Выберите картинку</label>
            </div>`
}
</script>
@endsection