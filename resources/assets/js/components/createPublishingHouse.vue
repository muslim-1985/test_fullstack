<template>
    <div class="modal fade" tabindex="-1" role="dialog" id="create_publishing_house_model">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Create Publishing House</h4>
                </div>
                <div class="modal-body">

                    <div class="alert alert-danger" v-if="errors.length > 0">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" placeholder="Publishing House Name" class="form-control" v-model="publishingHouse.title">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" @click="createPublishing()" class="btn btn-primary">Submit</button>
                    <!--<button type="button" @click="updateTask" class="btn btn-primary">Submit</button>-->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    import store from '../store/index'
    export default {
        name: "createPublishingHouse",
        data(){
            return {
                publishingHouse: {
                    title: ''
                },
                errors: []
            }
        },
        methods: {
            createPublishing()
            {
                return store.dispatch('createPublishing', this.publishingHouse.title).then(()=>{
                    this.reset();
                    $("#create_publishing_house_model").modal("hide");
                })
            },
            reset()
            {
                this.publishingHouse.title = ''
            },
        }
    }
</script>

<style scoped>

</style>