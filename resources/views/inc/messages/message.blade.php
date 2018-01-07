<style>
    #flash-message{
        display: none;
    }
</style>

<div id="flash-message"></div>

<script>
    var flashMessag = new Vue({
        el: "#flash-message",
        data:{
            message:{
                success: {!! Json_encode(Session::get('success')) !!},
                info: {!! Json_encode(Session::get('info')) !!},
                error: {!! Json_encode(Session::get('error')) !!},
            }
        },
        mounted: function() {
            let vm = this;
            this.$nextTick(function(e) {
                if (this.message.success != null){
                    this.success();
                }else if (this.message.info != null){
                    this.info();
                }else if (this.message.error != null){
                    this.danger();
                }
            });
        },
        methods:{
            success: function() {
                this.$toast.open({
                    message: this.message.success,
                    type: 'is-success',
                })
            },
            info: function() {
                this.$toast.open({
                    message: this.message.info,
                    type: 'is-info',
                })
            },
            danger: function() {
                this.$toast.open({
                    message: this.message.error,
                    type: 'is-danger',
                    duration: 5000,
                })
            },
        }
    });
</script>
