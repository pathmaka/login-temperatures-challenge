<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <br><h1>Login Temperatures</h1>
                <hr><br>
                <h2>Home</h2><br>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Chicago F</th>
                            <th scope="col">Chicago C</th>
                            <th scope="col">Colombo F</th>
                            <th scope="col">Colombo C</th>
                            
                        </tr>
                    </thead>
                    <tbody id="mytable">
                        <tr v-for="cust in viewData" >
                            <td>{{ cust.updated_at }}</td>
                            <td>{{ cust.chicago }}</td>
                            <td>{{ cust.chicago }}</td>
                            <td>{{ cust.colombo }}</td>
                            <td>{{ cust.colombo }}</td>
                            
                        </tr>
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                viewData: null,
                getTemps:{
                    user_id: 0,
                },
                
            }
        },

        methods: {
            init(){
                let userData = JSON.parse(localStorage.getItem('user'));
                let access_token = userData.access_token;
                this.getTemps.user_id = userData.id;
                const instance = axios.create({
                                    headers: {'Authorization': 'Bearer ' + access_token}
                                 });
                instance.post('/api/temperatures', this.getTemps).then(response => {
                    this.viewData = response.data;
                })
            },
        },

        mounted() {
            this.init();
        }
    }
</script>