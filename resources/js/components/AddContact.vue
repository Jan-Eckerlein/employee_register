<template>
    <div>
        <div class="container">
            <h2 class="text-center p-2 text-white bg-primary mt-5">Add Contact</h2>

            <div class="card-body">
                <div class="col-md-6 offset-md-3">
                    <form id="validateForm" @submit.prevent="saveContact" enctype="multipart/form-data">
                    
                     <!-- v-if="errors.lenghth" -->
                        <div class="alert alert-danger" v-if=this.errors.length>
                            <h5>Missing Data: {{this.errors.length}}</h5>
                            <ul class="mb-0">
                                <li v-for="(error, index) in this.errors" :key="index">
                                    {{ error }}
                                </li>
                            </ul>
                        </div>
<!-- 
                        <div class="from-group">
                            <label>Company ID:</label>

                            <select class="form-control" name="company_id">
                                <option v-for="company in companies" :key="company.id" :value="company.id">{{company.id}}</option>
                            </select>
                        </div> -->
                        

                        <div class="form-group">
                            <label for="company_id">Company ID</label>
                            <input type="text" id="company_id" v-model="contact.company_id" class="form-control" placeholder="Enter Company ID">
                        </div>

                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" v-model="contact.first_name" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" v-model="contact.last_name" class="form-control" placeholder="Enter Last Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label> <input type="email" id="email" v-model="contact.email" class="form-control" 
                            placeholder="Enter Email">
                        </div>

                        <!-- IMAGE -->

                        <!-- <div class="costom-file">
                            <input type="file" name="image" class="costom-file-input" id="validatedCostumFile" v-on:change="saveImage">
                            <label for="validatedCustomFile" class="custom-file-label">Choose file...</label>
                        </div> -->

                        <button class="btn btn-primary mt-4">Submit</button>
                    </form>
                </div>
            
            </div>
        </div>  
    </div>
</template>

<script>
export default {
    name: 'Company',
    created() {
        this.loadData();
    },
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
        saveContact() {
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
                // formData.append('image', this.image);
                let url = this.url + '/api/save_contact';   
                this.axios.post(url, formData).then((response) => {
                    if(response.status) {
                        this.$utils.showSuccess('success', response.message);
                        document.getElementById("company_id").value = '';
                        document.getElementById("first_name").value = '';
                        document.getElementById("last_name").value = '';
                        document.getElementById("email").value = '';
                        document.getElementById("validatedCustomFile").value = '';
                    }else {
                        this.$utils.showError('Error', response.message);
                    }
                }).catch(error => {
                    this.errors.push(error.response.data.errors);
                })
            }
        },
        // saveImage(e) {
        //     this.image = e.target.files[0];
        //     console.log(this.image);
        // }
    }
}
</script>

<style>

</style>