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
                    <th style="width: 20%">Фото</th>
                    <th style="width: 20%">Name</th>
                    <th style="width: 20%">Email</th>
                    <th>Дата создания</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td><img class="img-thumbnail" style="height: 50px" src="{{ $item->getThumbnail() }}"></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->getDate() }}</td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <i 
                                    data-action="update"
                                    data-route="{{ route('users.update', ['user' => $item->id]) }}" 
                                    data-id="{{ $item->id }}"
                                    data-name="{{ $item->name }}" 
                                    data-email="{{ $item->email }}" 
                                    data-thumbnail="{{ $item->getThumbnail() }}" 
                                    class="btn btn-info fas fa-edit"
                                ></i>
                                <i 
                                    data-action="delete"
                                    data-route="{{ route('users.destroy', ['user' => $item->id]) }}" 
                                    data-id="{{ $item->id }}"
                                    data-email="{{ $item->email }}" 
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
        <button class="btn btn-success">
            <i 
                data-action="create"
                data-route="{{ route('users.store') }}" 
                class="fas fa-plus-circle fa-2x"
            ></i>
        </button>
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
        let thumbnail = '/storage/no-image.jpg'

        let form = document.createElement('form')
        form.enctype = 'multipart/form-data'
        form.action = url
        form.method = 'POST'
        form.insertAdjacentHTML('beforeEnd', getTokenField())
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'text', name:'name', placeholder:'Name'}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'email', name:'email', placeholder:'Email'}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'password', name:'password', placeholder:'Password'}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'password', name:'password_confirmation', placeholder:'Retype Password'}))
        form.insertAdjacentHTML('beforeEnd', getImageForm( thumbnail ))

        form.addEventListener('change', event => {
            event.preventDefault()
            event.stopPropagation()

            if (event.target.id == 'thumbnail') {
                let file = event.target.files[0]

                document.getElementById('formImg').setAttribute('src', URL.createObjectURL(file))
                document.getElementById('thumbnailLabel').textContent = file.name
            }
        })
        document.body.append(form)
        
        swal({
            title: 'Создание пользователя', 
            content: form,
            buttons: true,
        })
        .then(ok => {
            if (!ok) throw null
            form.submit()
        })
    } else if (event.target.dataset.action == 'update') {
        let id = event.target.dataset.id
        let name = event.target.dataset.name
        let email = event.target.dataset.email
        let thumbnail = event.target.dataset.thumbnail
        let url = event.target.dataset.route

        let form = document.createElement('form')
        form.enctype = 'multipart/form-data'
        form.action = url
        form.method = 'POST'
        form.insertAdjacentHTML('beforeEnd', getTokenField())
        form.insertAdjacentHTML('beforeEnd', getMethodField( 'PUT' ))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'text', name:'name', placeholder:'Name', value:name}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'email', name:'email', placeholder:'Email', value:email}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'password', name:'password', placeholder:'Password'}))
        form.insertAdjacentHTML('beforeEnd', getInputField({type:'password', name:'password_confirmation', placeholder:'Retype Password'}))
        form.insertAdjacentHTML('beforeEnd', getImageForm( thumbnail ))

        form.addEventListener('change', event => {
            event.preventDefault()
            event.stopPropagation()

            if (event.target.id == 'thumbnail') {
                let file = event.target.files[0]

                document.getElementById('formImg').setAttribute('src', URL.createObjectURL(file))
                document.getElementById('thumbnailLabel').textContent = file.name
            }
        })
        document.body.append(form)
        
        swal({
            title: 'Обновление подписки', 
            content: form,
            buttons: true,
        })
        .then(ok => {
            if (!ok) throw null
            
            form.submit()
        })
    } else if (event.target.dataset.action == 'delete') {
        let id = event.target.dataset.id
        let email = event.target.dataset.email
        let url = event.target.dataset.route

        swal({
            title: 'Уделение подписки', 
            text: 'Вы уверены, что хотите удалить пользователя ' + email + '?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then(ok => {
            if (!ok) throw null

            let form = document.createElement('form')
            form.action = url
            form.method = 'POST'
            form.insertAdjacentHTML('afterbegin', getTokenField())
            form.insertAdjacentHTML('afterbegin', getMethodField( 'DELETE' ))
            document.body.append(form)
            form.submit()
        })
    }
})

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

function getImageForm( thumbnail ) {
    return `<img id="formImg" src="${thumbnail}" class='img-thumbnail mb-3'>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                <label class="custom-file-label" id="thumbnailLabel" for="thumbnail">Выберите картинку</label>
            </div>`
}
</script>
@endsection