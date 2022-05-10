<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <br><h1>Login Temperatures</h1>
                <hr><br>
                <h2>Login</h2>
                <form id="loginForm" v-on:submit.prevent="submitForm">
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" v-model="form.email" placeholder="Enter email">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" v-model="form.password" placeholder="Password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Login</button>

                    <router-link to="/register" class="btn btn-link">Register</router-link>
                    
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    let apiEndPoint = '/api/login';
    let saveEndPoint = '/api/savetemp';
    export default {

        data() {
            return {
               temperature:{
                   chicago: '200',
                   colombo: '60',
                   user_id: 0,
               },
               form: {
                    email: '',
                    password: '',
                },
            }

        },

        methods: {
            submitForm() {
                var _this = this;
                axios.post(apiEndPoint, this.form).then(response => {
                    localStorage.removeItem('user');
                    console.log("Succesfully login!");
                    localStorage.setItem('user', JSON.stringify(response.data));

                    this.saveTemp();
                    _this.$router.push('/home');
                    
                }).catch (error => {
                    console.log("Error login");
                    localStorage.removeItem('user');
                });
            },

            saveTemp(){
                let userData = JSON.parse(localStorage.getItem('user'));
                let access_token = userData.access_token;
                this.user_id = userData.id;
                const instance = axios.create({
                                    headers: {'Authorization': 'Bearer ' + access_token}
                                 });
                instance.post(saveEndPoint, this.temperature).then(response => {
                    console.log(response);
                }).catch (error => {
                    console.log("Error");
                });
            },


            //This is getting CORS issue. Need to move to the API middleware.
            init(){ 

                let chikagoPath = "https://api.openweathermap.org/data/2.5/onecall?lat=33.44&lon=-94.04&appid=8dc9ba99c4e5fe28f4dc20edbc1848c0";
                //axios.get(chikagoPath).then(response => {
                    //this.temperature.chikago = response.data.temp;
                    //console.log(this.temperature.chikago);
                //});

                let colomboPath = "https://api.openweathermap.org/data/2.5/onecall?lat=6.9271&lon=79.8612&appid=8dc9ba99c4e5fe28f4dc20edbc1848c0";
                //axios.get(colomboPath).then(response => {
                    //this.temperature.colombo = response.data.temp;
                    //console.log(this.temperature.colombo);
                //});

                //this.saveTemp();
            },
            
        },

        mounted() {
            this.init();
        },
    }
</script>