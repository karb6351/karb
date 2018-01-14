<template>
    <div>
        <article class="media single-post-list" v-for="post in postList">
            <figure class="media-left">
                <img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png">
            </figure>
            <div class="media-content">
                <div class="content">
                    <div class="content-top">
                        <a :href="profileUrl(post.userid)">
                            <small class="post-owner" :class="post.gender === 'male' ? 'is-male' : 'is-female'">{{ post.username }}</small>
                        </a>
                        <small class="post-created-at">{{ diffForHuman(post.created_at.date) }}</small>
                        <span class="icon is-small like-icon-positive m-left-5">
                        <i class="fa " :class=" positive? 'fa-thumbs-up' : 'fa-thumbs-down'" aria-hidden="true"></i>
                    </span>
                        <small class="like-number-icon">3</small>
                    </div>
                    <a :href="postUrl(post.id)"><strong><h4 class="title post-title">{{ post.topic }}</h4></strong></a>
                </div>
            </div>
            <div class="media-right p-right-5">
                <div class="topic-list-right-top">
                    <span class="tag category-tag" :class="categoryColor(post.category_name)">{{ post.category_name }} </span>
                </div>
                <div class="topic-list-right-bottom select is-rounded is-small m-top-5">
                    <select name="">
                        <option value="">Page 1</option>
                    </select>
                </div>
            </div>
        </article>
        <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">
              There is no more posts
            </span>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import axios from "axios";

    const url = "http://localhost:8000/api/category/";

    const moment = require('moment');
    console.log(moment().format());

    export default {
        props:{
            positive: {
                type: Boolean,
            },
            categoryID:{
                type: Number,
                required: true,
            }
        },
        data(){
            return {
                postList: [],
                listLength: 25,
            };
        },
        methods: {
            infiniteHandler($state){
                let vm = this;
                setTimeout(()=>{
                    axios.get(url + vm.categoryID , {
                        params:{
                            page: this.nextPage,
                            number: this.listLength,
                        }
                    }).then(function(response){
                        console.log(response.data);
                        if (response.data.post_list.length){
                            vm.postList = vm.postList.concat(response.data.post_list);
                            $state.loaded();
                            if (response.data.post_list.length < vm.listLength){
                                $state.complete();
                            }
                        }else{
                            $state.complete();
                        }
                        }).catch(function(error){
                            console.log(error);
                        })
                },500);
            },
            categoryColor: function(categoryName){
                switch (categoryName){
                    case 'Laravel':
                        return 'is-orange';
                    case 'Vuejs':
                        return 'is-primary';
                    case 'React':
                        return 'is-dark';
                    case 'Angular4':
                        return 'is-danger';
                }
            },
            diffForHuman: function(time){
                var utc = moment.utc(time).format();
                return moment(utc).fromNow();
            },
            postUrl: function (postID) {
                return "/post/" + postID;
            },
            profileUrl: function(userID){
                return "/user/" + userID;
            }
        },
        computed: {
            nextPage: function(){
                return (this.postList.length/this.listLength + 1)
            },
        },
        components: {
            InfiniteLoading,
        },
    };
</script>