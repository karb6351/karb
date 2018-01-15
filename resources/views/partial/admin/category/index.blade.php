@extends('layouts.manage')

@section('content')
    <div class="category-manage-tile">
        Category Management
    </div>
    <div class="columns" id="category">
        <div class="column is-7">
            <table class="table is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td class="categoryID">{{ $category->id }}</td>
                            <td class="categoryName">{{ $category->name }}</td>
                            <td><button class="button is-primary" @click="onEdit($event)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="column is-5">
            <div class="card">
                <div class="card-header">
                    <p class="card-header-title">
                        Create Category
                    </p>
                </div>
                <div class="card-content">
                    <form action="{{ route('admin.category.store') }}" method="post">
                        {{ csrf_field() }}
                        <b-field label="Name" message="{{ $errors->has('name')? 'is-danger': '' }}"
                                 type="{{$errors->has('name')? 'is-danger': ''}}">
                            <input class="input" name="name" placeholder="Enter Category name">
                        </b-field>
                        <button class="button is-fullwidth is-outlined is-link m-top-30">Create</button>
                    </form>
                </div>
            </div>
            <div class="card m-top-20">
                <div class="card-header">
                    <p class="card-header-title">
                        Edit Category
                    </p>
                </div>
                <div class="card-content">
                    <form action="{{ route('admin.category.update') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <b-field label="Id" message="{{ $errors->has('id')? 'is-danger': '' }}"
                                 type="{{$errors->has('name')? 'is-danger': ''}}">
                            <input class="input is-static" name="id" v-model="editID" readonly>
                        </b-field>
                        <b-field label="Name" message="{{ $errors->has('name')? 'is-danger': '' }}"
                                 type="{{$errors->has('name')? 'is-danger': ''}}">
                            <input class="input" name="name" v-model="editName">
                        </b-field>
                        <button class="button is-fullwidth is-outlined is-link m-top-30">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @include('inc.messages.message');
    <script>
        new Vue({
            el: '#category',
            data:{
                editName: '',
                editID: null,
            },
            methods:{
                onEdit: function(event){
                    this.editName = event.currentTarget.parentElement.previousElementSibling.textContent;
                    this.editID = event.currentTarget.parentElement.previousElementSibling.previousElementSibling.textContent;
                }
            }
        })
    </script>
@endsection