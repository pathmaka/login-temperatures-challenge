<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <br><h1>Login Temperatures</h1>
                <hr><br>
                <h2>Login</h2>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Login</button>

                    <router-link to="/register" class="btn btn-link">Register</router-link>
                    <router-link to="/home" class="btn btn-link">Home</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.');
        }
    }
</script>