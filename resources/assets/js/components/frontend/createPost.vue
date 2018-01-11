<template>
    <section>
        <div class="modal" :class="{'is-active': isCreatePostModalActive}" @click="isClose()">
            <div class="modal-background" ></div>
            <div class="modal-card" @click.stop="">
                <form action="{{ route('post.create') }}" method="post">
                    <header class="modal-card-head is-success">
                        <p class="modal-card-title">Create Post</p>
                        <button class="delete" aria-label="close" @click.prevent="isClose()"></button>
                    </header>
                    <section class="modal-card-body">
                        <div class="columns">
                            <div class="column is-8">
                                <b-field label="Topic" message="{{$errors->has('topic')? $errors->first('topic'): ''}}"
                                         type="{{$errors->has('topic')? 'is-danger': ''}}" required>
                                    <input name="topic" type="text" class="input" placeholder="Topic">
                                </b-field>
                            </div>
                            <div class="column is-4">
                                <b-field label="Category" message="{{$errors->has('categoryID')? $errors->first('categoryID'): ''}}"
                                         type="{{$errors->has('categoryID')? 'is-danger': ''}}" required>
                                    <b-select name="categoryID" placeholder="Select a category">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </b-select>
                                </b-field>
                            </div>
                        </div>
                        <div class="columns">
                            <div class="column is-12">
                                <b-field label="Content" label="Content" message="{{$errors->has('content')? $errors->first('content'): ''}}"
                                         type="{{$errors->has('content')? 'is-danger': ''}}" required>
                                    <b-input name="content" maxlength="1000" type="textarea" placeholder="Your views..."></b-input>
                                </b-field>
                            </div>
                        </div>
                    </section>
                    <footer class="modal-card-foot">
                        <button class="button is-info" type="submit">Create</button>
                        <button class="button" @click.prevent="isClose()">Cancel</button>
                    </footer>
                </form>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            isLogin:{
                type: boolean,
            },
            submitLink:{
                type:string,
            }
        },
        data() {
            return {
                isCreatePostModalActive: false,
            }
        },
        methods(){
            return {
                isOpen: function(){
                    if (this.isLogin){
                        this.isCreatePostModalActive = true;
                    }else{
                        this.$snackbar.open({
                            message: "You should login first",
                            type: "is-warning",
                            position: 'is-top',
                            duration: 5000
                        })
                    }
                },
                isClose: function(){
                    this.$dialog.confirm({
                        message: 'Are you sure to exit, your work will not be saved',
                        type: 'is-info',
                        onConfirm: () => {
                            this.isCreatePostModalActive = false;
                        }
                    })

                }
            }
        },
    }
</script>