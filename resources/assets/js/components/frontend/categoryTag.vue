<template>
    <span class="tag m-left-5" :class="categoryColor(categoryName)">{{ categoryName }}</span>
</template>

<script>
    export default {
        props: {
            categoryName:{
                type: String,
            }
        },
        data() {
            return {

            };
        },
        methods: {
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
                    case 'CodeIgniter' :
                        return 'is-dark-orange';
                }
            },
        },
    }
</script>