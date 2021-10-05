<template>
    <div>
        <div class="container">
            <h2 class="text-center p-2 text-white bg-primary mt-5">Add Contact</h2>

            <div class="card-body">
                <div class="col-md-6 offset-md-3">
                    <form id="validateForm" @submit.prevent="updateContact" enctype="multipart/form-data" novalidate>
                    
                     <!-- v-if="errors.lenghth" -->
                        <div class="alert alert-danger" v-if=this.errors.length>
                            <h5>Missing Data: {{this.errors.length}}</h5>
                            <ul class="mb-0">
                                <li v-for="(error, index) in this.errors" :key="index">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>


                        <div class="form-group">
                            <label for="company_id">Name</label>
                            <input type="text" id="company_id" v-model="contact.company_id" class="form-control" placeholder="Enter Company ID">
                        </div>
                        <div class="form-group">
                            <label for="first_name">Email</label>
                            <input type="text" id="first_name" v-model="contact.first_name" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Designation</label>
                            <input type="text" id="last_name" v-model="contact.last_name" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Contact Number</label> <input type="email" id="contact_no" v-model="contact.email" class="form-control" 
                            placeholder="Enter Email">
                        </div>

                        <div class="form-group" v-if="contact.image">
                            <img :src="`${url + '/' + contact.image}`" alt="image" width="100" height="150">
                        </div>

                        <div class="costom-file">
                            <input type="file" name="image" class="costom-file-input" id="validatedCostumFile" v-on:change="onImageChange">
                            <label for="validatedCustomFile" class="custom-file-label">Choose file...</label>
                        </div>

                        <button class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    data() {
        return {
            url: document.head.querySelector('meta[name="url').content,
            contact: {},
            company_id:'',
            first_name:'',
            last_name:'',
            email:'',
            errors: [],
        }
    },
    methods: {
        loadData() {
            let url = this.url + `/api/get_contact/${this.$route.params.id}`;
            this.axios.get(url).then((response) => {
                this.contact = response.data;
                console.log(this.contact);
            });
        },
        updateContact() {
            this.errors = [];
            if(!this.contact.first_name) {
                this.errors.push('First name is required');
            }
            if(!this.contact.last_name) {
                this.errors.push('Last name is required');
            }
            
            if(!this.errors.length) {
                let formData = new FormData();
                formData.append('company_id', this.contact.company_id);
                formData.append('first_name', this.contact.first_name);
                formData.append('last_name', this.contact.last_name);
                formData.append('email', this.contact.email);
                formData.append('image', this.image);
                let url = this.url + `/api/update_contact/${this.$route.params.id}`;   
                this.axios.post(url, formData).then((response) => {
                    if(response.status) {
                        this.$utils.showSuccess('success', response.message);
                        this.$router.push({
                            name:'/'
                        });
                    }else {
                        this.$utils.showError('Error', response.message);
                    }
                }).catch(error => {
                    this.errors.push(error.response.data.errors);
                })
            }
        },
        onImageChange(e) {
            this.image = e.target.files[0];
            console.log(this.image);
        }
    },
    created() {
        this.loadData();
    },
    mounted: function() {
        console.log('Edit Contact Component Loaded');
    }
}
</script>

<style>

</style>