@extends('admin.layouts.layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Подписки</h3>
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
                        Email
                    </th>
                    <th>Статус</th>
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
                @foreach ($subs as $item)
                    <tr data-id="{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->email }}</td>
                        <td class="column-status">
                            @if ($item->isConfirmed())
                                <i class="fas fa-check-circle btn btn-success"></i>
                            @else
                                <i 
                                    data-action="verify"
                                    data-route="{{ route('subs.verify', ['token' => $item->token]) }}" 
                                    data-id="{{ $item->id }}"
                                    data-token="{{ $item->token }}" 
                                    data-email="{{ $item->email }}" 
                                    class="btn btn-danger fas fa-check-circle"
                                ></i>
                        @endif
                        </td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td class="project-actions text-right">
                            <div class="btn-group">
                                <i 
                                    data-action="update"
                                    data-route="{{ route('subs.update', ['sub' => $item->id]) }}" 
                                    data-id="{{ $item->id }}"
                                    data-email="{{ $item->email }}" 
                                    class="btn btn-info fas fa-edit"
                                ></i>
                                <i 
                                    data-action="delete"
                                    data-route="{{ route('subs.destroy', ['sub' => $item->id]) }}" 
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
                data-route="{{ route('subs.store') }}" 
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

        let form = document.createElement('form')
        form.action = url
        form.method = 'POST'
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_token" value="{{ csrf_token() }}">')
        form.insertAdjacentHTML('afterbegin', '<input type="email" name="email" placeholder="Email">')
        document.body.append(form)
        
        swal({
            title: 'Создание подписки', 
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
            text: 'Вы уверены, что хотите удалить подписку ' + email + '?',
            icon: 'error',
            buttons: true,
            dangerMode: true,
        })
        .then(ok => {
            if (!ok) throw null

            let form = document.createElement('form')
            form.action = url
            form.method = 'POST'
            form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_token" value="{{ csrf_token() }}">')
            form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="DELETE">')
            document.body.append(form)
            form.submit()
        })

    } else if (event.target.dataset.action == 'update') {
        let id = event.target.dataset.id
        let email = event.target.dataset.email
        let url = event.target.dataset.route

        let form = document.createElement('form')
        form.action = url
        form.method = 'POST'
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_token" value="{{ csrf_token() }}">')
        form.insertAdjacentHTML('afterbegin', '<input type="hidden" name="_method" value="PUT">')
        form.insertAdjacentHTML('afterbegin', '<input type="email" name="email" value="' + email + '">')
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
    } else if (event.target.dataset.action == 'verify') {
        let id = event.target.dataset.id
        let email = event.target.dataset.email
        let url = event.target.dataset.route

        swal({
            title: 'Подтверждение подписки', 
            text: 'Вы уверены, что хотите подтвердить подписку ' + email + '?',
            icon: 'warning',
            buttons: true,
        })
        .then(ok => {
            if (!ok) throw null
            return fetch(url)
        })
        .then(result => {
            newval = '<i class="fas fa-check-circle btn btn-success"></i>' 
            document.querySelector('tr[data-id="' + id + '"] td.column-status').innerHTML = newval
        })
    }
})
</script>
@endsection