<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <br><h1>Login Temperatures</h1>
                <hr><br>
                <div class="row">
                    <div class="col-6">
                        <h2>Home</h2>
                    </div>
                    <div class="col-6">
                        <form id="loginForm" v-on:submit.prevent="submitFormLogout">
                            <button type="submit" class="btn btn-warning float-right">Logout</button>
                        </form>
                    </div>
                </div>

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
                            <td>{{ parseInt(cust.chicago) - 32 }}</td>
                            <td>{{ cust.colombo }}</td>
                            <td>{{ parseInt(cust.colombo) - 32 }}</td>
                            
                        </tr>
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</template>

<script>
    let apiEndPointLogout = '/api/logout';
    export default {

        data() {
            return {
                viewData: null,
                getTemps:{
                    user_id: "",
                },
                
            }
        },

        methods: {
            init(){
                if(localStorage.getItem('user')){
                    let userData = JSON.parse(localStorage.getItem('user'));
                    let access_token = userData.access_token;
                    this.getTemps.user_id = userData.id;
                    const instance = axios.create({
                                        headers: {'Authorization': 'Bearer ' + access_token}
                                    });
                    instance.post('/api/temperatures', this.getTemps).then(response => {
                        this.viewData = response.data;
                    });
                }else{
                    this.$router.push('/login');
                }
                
            },

            submitFormLogout() {
                var _this = this;
                let userData = JSON.parse(localStorage.getItem('user'));
                let access_token = userData.access_token;
                const instanceLogout = axios.create({
                                    headers: {'Authorization': 'Bearer ' + access_token}
                                });
                instanceLogout.post(apiEndPointLogout).then(response => {
                    localStorage.removeItem('user');
                    _this.$router.push('/logout');
                });
            },
        },

        mounted() {
            this.init();
        }
    }
</script>