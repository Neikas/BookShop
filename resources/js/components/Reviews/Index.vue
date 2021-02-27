<template>
<div>
    <h4 class="card-title">Latest Reviews</h4>
    <div class="col-lg-12" v-for="review in reviews.data" :key="review.id">
        <div class="card">
            <div class="comment-widgets w-100">
                <div class="d-flex flex-row comment-row m-t-0">
                    <div class="comment-text w-100">
                        <h6 class="font-medium">{{ review.author}}  <teamplate v-for="index in review.stars" :key="index"><i class="fa fa-star"></i></teamplate></h6> 
                        <span class="m-b-15 d-block">{{ review.comment}}</span>
                        <div class="comment-footer"> <span class="text-muted float-right">{{review.created_at}}</span> </div>
                    </div>
                </div> <!-- Comment Row -->
            </div> <!-- Card -->
        </div>
    </div>
</div>
</template>

<script>
        export default {
            props:{
                book:{
                    type: Object,
                    required: true,
                },
            },
            data(){
                return {
                    reviews: [],
                }
             },

            mounted() {
                axios.get(`/api/v1/reviews/${this.book.id}`).then(response => {
                    this.reviews = response.data;
                });
            },


        }
</script>