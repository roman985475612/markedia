@extends('admin.layouts.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Статьи</h3>
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
                    <th style="width: 1%">
                        ID
                    </th>
                    <th>Картинка</th>
                    <th style="width: 10%">
                        Наименование
                    </th>
                    <th style="width: 10%">
                        Slug
                    </th>
                    <th style="width: 30%">Описание</th>
                    <th style="width: 15%">Категория</th>
                    <th style="width: 20%">Теги</th>
                    <th style="width: 20%">
                        Дата создания<br>
                        дата обнавления
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr data-id="{{ $post->id }}">
                        <td>{{ $post->id }}</td>
                        <td><img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}" class="img-thumbnail"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{!! $post->description !!}</td>
                        <td>{{ $post->category->title }}</td>
                        <td>
                            @forelse ($post->getTagsTitle() as $tag)
                                <span class="badge badge-primary">{{ $tag }}</span>   
                            @empty
                                --
                            @endforelse
                        </td>
                        <td>
                            <small>{{ $post->created_at }}</small><br>
                            <small>{{ $post->updated_at }}</small>
                        </td>
                        <td></td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <a 
                                    data-action="update"
                                    data-id="{{ $post->id }}"
                                    data-title="{{ $post->title }}" 
                                    data-description="{{ $post->description }}" 
                                    data-content="{{ $post->content }}" 
                                    data-src="{{ $post->thumbnail }}" 
                                    data-category_id="{{ $post->category_id }}" 
                                    data-tags="{{ $post->getTags() }}" 
                                    class="btn btn-info btn-sm"
                                    href="#">
                                    <i class="fas fa-edit">
                                    </i>
                                </a>
                                <a 
                                    data-action="delete"
                                    data-id="{{ $post->id }}"
                                    data-title="{{ $post->title }}" 
                                    class="btn btn-danger btn-sm" 
                                    href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                </a>
                            </div>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>
    <!-- /.card-body -->
    <div class="card-footer">
      <a 
        id="createTag"
        class="btn btn-success btn-sm" 
        href="{{ route('posts.create') }}">
        <i class="fas fa-plus-circle"></i>&nbsp;
        Новая
    </a>
    </div>
    <!-- /.card-footer-->
</div>

<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form
                id="actionForm"
                action=""
                method="POST"
                enctype="multipart/form-data">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
          <button type="button" class="btn btn-danger" data-action="" data-id="" id="actionBtn" data-dismiss="modal"></button>
        </div>
      </div>
    </div>
</div>
  
@endsection

@section('scripts')
<script>
// Форма загрузки картинки
document.getElementById('actionModal').addEventListener('change', event => {
    event.preventDefault()
    event.stopPropagation()

    if (event.target.id == 'thumbnail') {
        let file = event.target.files[0]

        document.getElementById('thumbnailLabel').textContent = file.name
        
        let formImg = document.getElementById('formImg')
        formImg.setAttribute('src', URL.createObjectURL(file))
        formImg.classList.remove('d-none')
    }
})

// Создание
document.getElementById('createTag').addEventListener('click', event => {
    event.preventDefault()
    event.stopPropagation()

    document.querySelector('#actionModal .modal-title').textContent = 'Создание статьи'

    let actionForm = document.getElementById('actionForm')
    actionForm.innerHTML = ''

    let obj = {
        title: '',
        description: '',
        content: '',
        src: ''
    }
    actionForm.insertAdjacentHTML('afterbegin', fields(obj))
    
    fetch('/admin/categories/list')
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('category_id')

            let options
            for (var key in data) {
                    options += `<option value="${key}">${data[key]}</option>`
            }
            select.insertAdjacentHTML('beforeend', options)
        })

    fetch('/admin/tags/list')
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('tags')
            
            let options
            for (var key in data) {
                    options += `<option value="${key}">${data[key]}</option>`
            }
            select.insertAdjacentHTML('beforeend', options)
        })

    let actionBtn = document.getElementById('actionBtn')
    actionBtn.setAttribute('data-action', 'create')
    if (actionBtn.classList.contains('btn-danger')) {
        actionBtn.classList.remove('btn-danger')
    }
    actionBtn.classList.add('btn-success')
    actionBtn.textContent = 'Сохранить'

    ClassicEditor
        .create( document.querySelector( '#content' ), {
            ckfinder: {
                uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
            },
            toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        } )
        .catch( function( error ) {
            console.error( error );
        } );

    ClassicEditor
        .create( document.querySelector( '#description' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
        } )
        .catch( function( error ) {
            console.error( error );
        } );


    $('.select2').select2()
    $('#actionModal').modal('show')

})

// Обновление, удаление
document.querySelector('.card-body').addEventListener('click', event => {
    event.preventDefault()
    event.stopPropagation()

    if (event.target.dataset.action == 'delete') {
        let id = event.target.dataset.id
        let title = event.target.dataset.title
        
        document.querySelector('#actionModal .modal-title').textContent = 'Удаление статьи'
        
        const text = `Вы уверены, что хотите удалить категорию <b>${title}</b> (<b>#${id}</b>)?`
        let actionForm = document.getElementById('actionForm')
        actionForm.innerHTML = ''
        actionForm.insertAdjacentHTML('beforeend', text)
        
        let actionBtn = document.getElementById('actionBtn')
        actionBtn.setAttribute('data-id', id)
        actionBtn.setAttribute('data-action', 'delete')
        if (actionBtn.classList.contains('btn-success')) {
            actionBtn.classList.remove('btn-success')
        }
        actionBtn.classList.add('btn-danger')
        actionBtn.textContent = 'Удалить'

        $('#actionModal').modal('show')
    } else if (event.target.dataset.action == 'update') {
        let id = event.target.dataset.id
        let category_id = event.target.dataset.id
        let tags = JSON.parse(event.target.dataset.tags)
        
        document.querySelector('#actionModal .modal-title').textContent = 'Редактирование статьи'

        let actionForm = document.getElementById('actionForm')
        actionForm.innerHTML = ''

        let obj = {
            title: event.target.dataset.title,
            description: event.target.dataset.description,
            content: event.target.dataset.content,
            src: event.target.dataset.src
        }
        actionForm.insertAdjacentHTML('afterbegin', fields(obj))

        fetch('/admin/categories/list')
            .then(response => response.json())
            .then(data => {
                let select = document.getElementById('category_id')

                let options = ''
                for (var key in data) {
                        options += `<option value="${key}"`
                        
                        if (key == category_id) {
                            options += ' selected'
                        }

                        options += `>${data[key]}</option>`
                }
                select.insertAdjacentHTML('beforeend', options)
            })

        fetch('/admin/tags/list')
            .then(response => response.json())
            .then(data => {
                let select = document.getElementById('tags')
                
                for (var key in data) {
                    options = `<option value="${key}"`
                    for (let i in tags) {
                        if (tags[i] == key) {
                            options += ' selected'
                            break
                        }
                    }
                    options += `>${data[key]}</option>`
                    select.insertAdjacentHTML('beforeend', options)
                }
            })
        
        let actionBtn = document.getElementById('actionBtn')
        actionBtn.setAttribute('data-id', id)
        actionBtn.setAttribute('data-action', 'update')
        if (actionBtn.classList.contains('btn-danger')) {
            actionBtn.classList.remove('btn-danger')
        }
        actionBtn.classList.add('btn-success')
        actionBtn.textContent = 'Сохранить'

        ClassicEditor
            .create( document.querySelector( '#content' ), {
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                },
                toolbar: [ 'ckfinder', 'imageUpload', '|', 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );

        ClassicEditor
            .create( document.querySelector( '#description' ), {
                toolbar: [ 'heading', '|', 'bold', 'italic', '|', 'undo', 'redo' ]
            } )
            .catch( function( error ) {
                console.error( error );
            } );

        $('.select2').select2()
        $('#actionModal').modal('show')

    }
})

// Отправка формы
document.getElementById('actionBtn').addEventListener('click', event => {
    $('#actionModal').modal('hide')

    let route
    let method
    let action = event.target.dataset.action
    if (action == 'delete') {
        let id = event.target.dataset.id
        route = `/admin/posts/${id}`
        method = "DELETE"
    } else if (action == 'update') {
        let id = event.target.dataset.id
        route = `/admin/posts/${id}`
        method = "PUT"
    } else if (action == 'create') {
        route = '/admin/posts'
        method = "POST"
    }

    const csrf_token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    let form = document.getElementById('actionForm')
    form.insertAdjacentHTML('afterbegin', `<input type="hidden" name="_method" value="${method}">`)
    form.insertAdjacentHTML('afterbegin', `<input type="hidden" name="_token" value="${csrf_token}">`)    
    form.setAttribute('action', route)
    form.submit()
})

// Шаблон формы
function fields(obj) {
    let imgClass = ''
    if (!obj.src) {
        imgClass = 'd-none'
    } else {
        obj.src = '/storage/uploads/' + obj.src
    }

    return `
    <div class="card-body">
        <div class="form-group">
            <label for="title">Наименование</label>
            <input name="title" value="${obj.title}" type="text" class="form-control" id="title" placeholder="Наименование статьи">
        </div>
        <div class="form-group">
            <label for="description">Цитата</label>
            <textarea name="description" class="form-control" id="description" placeholder="Цитата">${obj.description}</textarea>
        </div>
        <div class="form-group">
            <label for="content">Контент</label>
            <textarea name="content" class="form-control" id="content" placeholder="Контент">${obj.content}</textarea>
        </div>
        <div class="form-group">
            <label for="category_id">Категория</label>
            <select id="category_id" name="category_id" class="custom-select">
                <option selected>Укажите категорию...</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tags">Теги</label>
            <select id="tags" name="tags[]" class="select2" multiple="multiple" data-placeholder="Выбор тегов" style="width: 100%;">
            </select>
        </div>
        <img id="formImg" src="${obj.src}" class='img-thumbnail mb-3 ${imgClass}'>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
            <label class="custom-file-label" id="thumbnailLabel" for="thumbnail">Выберите картинку</label>
        </div>
    </div>`
}

</script>
@endsection