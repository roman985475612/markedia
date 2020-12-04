@extends('admin.layouts.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Теги</h3>
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
                    <th style="width: 20%">
                        Наименование
                    </th>
                    <th style="width: 30%">
                        Slug
                    </th>
                    <th>
                        Дата создания
                    </th>
                    <th>
                        дата обнавления
                    </th>
                    <th style="width: 20%">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr data-id="{{ $tag->id }}">
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td>{{ $tag->created_at }}</td>
                        <td>{{ $tag->updated_at }}</td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <a 
                                    data-action="update"
                                    data-id="{{ $tag->id }}"
                                    data-title="{{ $tag->title }}" 
                                    class="btn btn-info btn-sm"
                                    href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a 
                                    data-action="delete"
                                    data-id="{{ $tag->id }}"
                                    data-title="{{ $tag->title }}" 
                                    class="btn btn-danger btn-sm" 
                                    href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
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
        href="{{ route('tags.create') }}">
        <i class="fas fa-plus-circle"></i>&nbsp;
        Новая
    </a>
    </div>
    <!-- /.card-footer-->
</div>

<!-- Modal -->
<div class="modal fade" id="actionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                method="POST">
                @csrf
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
document.querySelector('.card-body').addEventListener('click', event => {
    event.preventDefault()
    event.stopPropagation()

    if (event.target.dataset.action == 'delete') {
        let id = event.target.dataset.id
        let title = event.target.dataset.title
        
        document.querySelector('#actionModal .modal-title').textContent = 'Удаление тега'
        
        const text = `Вы уверены, что хотите удалить категорию <b>${title}</b> (<b>#${id}</b>)?`
        const actionForm = document.getElementById('actionForm')
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
        let title = event.target.dataset.title
        
        document.querySelector('#actionModal .modal-title').textContent = 'Редактирование тега'
        document.getElementById('actionForm').insertAdjacentHTML('afterbegin', fields(title))
        
        let actionBtn = document.getElementById('actionBtn')
        actionBtn.setAttribute('data-id', id)
        actionBtn.setAttribute('data-action', 'update')
        if (actionBtn.classList.contains('btn-danger')) {
            actionBtn.classList.remove('btn-danger')
        }
        actionBtn.classList.add('btn-success')
        actionBtn.textContent = 'Сохранить'

        $('#actionModal').modal('show')

    }
})

// Создание
document.getElementById('createTag').addEventListener('click', event => {
    event.preventDefault()
    event.stopPropagation()

    document.querySelector('#actionModal .modal-title').textContent = 'Создание тега'

    document.getElementById('actionForm').insertAdjacentHTML('afterbegin', fields())
    
    let actionBtn = document.getElementById('actionBtn')
    actionBtn.setAttribute('data-action', 'create')
    if (actionBtn.classList.contains('btn-danger')) {
        actionBtn.classList.remove('btn-danger')
    }
    actionBtn.classList.add('btn-success')
    actionBtn.textContent = 'Сохранить'

    $('#actionModal').modal('show')

})

document.getElementById('actionBtn').addEventListener('click', event => {
    $('#actionModal').modal('hide')

    let form = document.getElementById('actionForm')
    let action = event.target.dataset.action

    let route
    if (action == 'delete') {
        let id = event.target.dataset.id
        route = `/admin/tags/${id}`
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="DELETE">')
    } else if (action == 'update') {
        let id = event.target.dataset.id
        route = `/admin/tags/${id}`
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">')
    } else if (action == 'create') {
        route = '/admin/tags'
    }

    form.setAttribute('action', route)
    form.submit()
})

function fields(value = '') {
    return `
    <div class="card-body">
        <div class="form-group">
        <label for="title">Наименование</label>
        <input name="title" value="${value}" type="text" class="form-control" id="title" placeholder="Наименование тега">
        </div>
    </div>
`
}

</script>
@endsection