<template>
    <div >
        <div :id="getFloor(index)" class="column column is-three-fifths is-offset-one-fifth  m-top-15" v-for="(reply,index) in replyList">
            <article class="media" >
                <figure class="media-left m-top-10 has-text-centered">
                    <p class="image is-64x64"><img class="user-icon" src="https://bulma.io/images/placeholders/128x128.png"></p>

                </figure>
                <div class="media-content">
                    <div class="content">
                        <div class="level reply-body">
                                <span class="level-left">
                                    <a :href="profileUrl(reply.userID)">
                                        <strong class="m-left-5" :class="reply.gender === 'male'? 'is-male': 'is-female' ">{{ reply.username }}</strong></a>
                                    <span class="icon has-icon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                                     <b-tooltip type="is-light" position="is-bottom" label="time">
                                            <small class="has-text-grey-light">{{ diffForHuman(reply.created_at.date) }}</small>
                                     </b-tooltip>
                                     <!--<b-tooltip type="is-light" position="is-bottom" label="Reply this comment">-->
                                         <!--<a href="#" class="icon has-icon reply-icon" @click.prevent="onReplyComment""><i class="fa fa-reply" aria-hidden="true"></i></a>-->
                                     <!--</b-tooltip>-->
                                </span>
                            <span class="level-right m-right-10">#{{ index + 2 }}</span>
                        </div>
                        <p class="m-top-5 m-left-10" id="">{{ reply.content }}</p>
                    </div>
                </div>
            </article>
        </div>
        <infinite-loading @infinite="infiniteHandler">
            <span slot="no-more">
              There is no more Reply
            </span>
        </infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import axios from "axios";

    const url = "http://localhost:8000/api/post/";

    const moment = require('moment');
    console.log(moment().format());

    export default {
        props:{
            positive: {
                type: Boolean,
            },
            postID:{
                type: Number,
                required: true,
            },
            selectedPage:{
                type: Number,
            }
        },
        data(){
            return {
                replyList: [],
                listLength: 25,
                currentPage: null,
            };
        },
        methods: {
            infiniteHandler($state){
                let vm = this;
                setTimeout(()=>{
                    axios.get(url + vm.postID , {
                        params:{
                            page: this.nextPage,
                            number: this.listLength,
                        }
                    }).then(function(response){
                        console.log(response.data);
                        if (response.data.reply_list.length){
                            vm.replyList = vm.replyList.concat(response.data.reply_list);
                            $state.loaded();
                            if (response.data.reply_list.length < vm.listLength){
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
            profileUrl: function(userID){
                return "/user/" + userID;
            },
            getFloor: function(index){
                return 'floor-' + (index + 2);
            },
            onReplyComment: function(){

            },
        },
        computed: {
            nextPage: function(){
                return (this.replyList.length/this.listLength + 1)
            },
        },
        watch:{
            currentPage: function(){
                console.log('current Page:' + this.currentPage );
                this.$emit('currentPage',this.currentPage);
            }
        },
        created: function(){
            this.currentPage = this.selectedPage;
        },
        components: {
            InfiniteLoading,

        },
    };
</script>