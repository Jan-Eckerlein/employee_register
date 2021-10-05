<template>
  <div class="container">
      <!-- <h2>Contact Page</h2> -->
      <h2 class="text-center p-2 text-white bg-primary mt-5">Contacts</h2>

      <table class="table">
          <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">company name</th>
              </tr>
          </thead>
        	<!-- loading db data -->
          <tbody v-for="company in companies" :key="company.id">
              <tr>
                  <th scope="row">{{ company.id }}</th>
                  <td>{{ company.company_name }}</td>
                  <!-- <td><button class="btn btn-danger btn-sm" @click.prevent="deleteContact(contact.id)">Delete</button></td>
                  <td><router-link :to="{name:'/get_contact', params: {id:contact.id} }" class="btn btn-primary btn-sm">Edit</router-link></td>             -->
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
export default {
    name: 'Company',
    created() {
        this.loadData();
    },
    methods: {
        loadData() {
            let url = this.url + '/api/getCompanies';
            this.axios.get(url).then(response => {
                this.companies = response.data
                console.log(this.companies);
            }); 
        },
    },
    mounted() {
        console.log('Conctact List Component Mounted');
    },
    data(){
        return {
            url: document.head.querySelector('meta[name="url"]').content,
            companies:[]
        }
    }

}
</script>

<style>

</style>