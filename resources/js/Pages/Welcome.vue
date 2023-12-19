<template>
   
            <div v-if="canLogin" class="welcomepage">
              <img :src="'/storage/images/logo.jpg'" alt="logo" class="logo">
                <inertia-link href="#" v-if="$page.props.user" class="text-lg text-gray-700 underline">
                    Dashboard
                </inertia-link>
                <template v-else>
                    <br><br><br><br><br>
                    <center> <h1> SOCIAL NETWORKING PLATFORM</h1> 
                    <span class="divider"></span></center>
                    <br><br>
                   <center> <inertia-link :href="route('login')" class="btn1">Login</inertia-link>
                    <br><br><br>
                    <inertia-link :href="route('register')" v-if="canRegister" class="btn1">
                        Register
                    </inertia-link></center>
                </template>
           <br><br>
          <center> <p class="activemembers">{{ users }} active members</p></center>

        </div>
        							
</template>

<script>
    export default {
        props: {
            users: Number,
            canLogin: Boolean,
            canRegister: Boolean,
            laravelVersion: String,
            phpVersion: String,
        }
    }
</script>
<style>
.welcomepage {
        background-image: url('/storage/images/social2.png');
        background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height:900px;
    
        
    }

  .logo {
    width: 85px; /*  width and height of the logo */
    height: 80px;
    position: absolute;
    top: 10px;
    left: 10px;
  }
  .btn1 {
    font-size: 500%;
    padding: 16px 35px;
    background-color: darkgray;
    color: black;
    font-weight: bolder;
    border-radius: 14px;
    border: aliceblue;
    border: 1px solid aliceblue;
}
.divider{
  width: 600px;
  height: 5px;
  background-color: black;
  display: inline-block;
  border-radius: 50%;
}
  h1{
    font-size: 400%;
    font-weight: bold;
    color: white;
    font-style: OBLIQUE;
    font-family: Noto Sans;
}

  
  .activemembers {
    font-size: 22px;
    color: white;
    font-weight: bolder;
}



</style>