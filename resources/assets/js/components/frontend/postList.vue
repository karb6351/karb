<template>
    <div>
        <article class="media single-post-list" v-for="post in postList">
            <figure class="media-left">
                <img class="user-icon" :src="gravatar(post.gravatarHash)">
            </figure>
            <div class="media-content">
                <div class="content">
                    <div class="content-top">
                        <a :href="profileUrl(post.userid)">
                            <small class="post-owner" :class="post.gender === 'male' ? 'is-male' : 'is-female'">{{ post.username }}</small>
                        </a>
                        <small class="post-created-at">{{ diffForHuman(post.created_at.date) }}</small>
                        <span class="icon is-small m-left-5" :class=" (rating(post.likeNumber,post.dislikeNumber) >= 0 )? 'like-icon-positive' : 'like-icon-negative' ">
                        <i class="is-dark fa " :class=" (rating(post.likeNumber,post.dislikeNumber) >= 0 )? 'fa-thumbs-up' : 'fa-thumbs-down'" aria-hidden="true"></i>
                    </span>
                        <small class="like-number-icon ">{{ rating(post.likeNumber,post.dislikeNumber) }}</small>
                    </div>
                    <a :href="postUrl(post.id)"><strong><h4 class="title post-title">{{ post.topic }}</h4></strong></a>
                </div>
            </div>
            <div class="media-right p-right-5">
                <div class="topic-list-right-top">
                    <category-tag :category-name="post.category_name"></category-tag>
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
    import categoryTag from './categoryTag';
    import axios from "axios";

    const url = "http://localhost:8000/api/category/";

    const moment = require('moment');

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
            diffForHuman: function(time){
                var utc = moment.utc(time).format();
                return moment(utc).fromNow();
            },
            postUrl: function (postID) {
                return "/post/" + postID;
            },
            profileUrl: function(userID){
                return "/user/" + userID;
            },
            rating: function(likeNumber, dislikeNumber){
                return likeNumber - dislikeNumber;
            },
            gravatar: function(gravatar){
                console.log(gravatar);
                return "https://www.gravatar.com/avatar/" + gravatar + "?s=50&d=mm";
            }
        },
        computed: {
            nextPage: function(){
                return (this.postList.length/this.listLength + 1)
            },
        },
        components: {
            InfiniteLoading,
            categoryTag,
        },
    };
</script>