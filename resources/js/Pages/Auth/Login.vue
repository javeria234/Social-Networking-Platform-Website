<template>
   <center><div class="loginpage">
    
    <img :src="'/storage/images/logo.jpg'" alt="logo" class="logo">
        <br><br>
        <center> <h1> SOCIAL NETWORKING PLATFORM</h1>
        <span class="divider"></span></center>
                    <br><br><br>
        <form @submit.prevent="submit" class="loginform">
        <jet-validation-errors />
  
            <h3>Login Page</h3>
    <p class="loginheader"> Please fill in the details below to login</p>
            <div>
                <jet-label for="email" value="Email" class="email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" class="password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model="form.remember" />
                    <span class="ml-2">Remember me</span>
                </label>
            </div>

            <div class="forgotpassword">
                <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-white-600 hover:text-gray-900">
                    Forgot your password?
                </inertia-link>

                <jet-button class="loginbutton" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </jet-button>
            </div>
            
        </form>
    </div></center>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>

<style>
.loginpage {
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
  .divider{
  width: 600px;
  height: 5px;
  background-color: black;
  display: inline-block;
  border-radius: 50%;
}
  .loginform {
    background-color: black;
		width: 29%;
		box-sizing: border-box;
    max-height: 420px;
    overflow-y: auto;
		font-size: 20px;
       color: black;
    padding: 1rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }
  
  .loginbutton{
    font-size: 15px;
    background-color: black;
    float: right;
  }
  .ml-2{
    font-size: 15px;
    color: white;
  }
  .forgotpassword{
    color: white;
    float: right;
  }
  .email{
    color: white;
    float: left;
  }
  .password{
    color: white;
    float: left;
  }
  h1{
    font-size: 400%;
    font-weight: bold;
    color: white;
    font-style: OBLIQUE;
    font-family: Noto Sans;
  }
  .loginheader{
    color: white;
    
  }
  h3{
    color: white;
    
  }
  /* .errormsg{
    color: red;
    font-size: 9px;
    font-weight: bold;
  } */
  

/* header{
   
   background-color: black;
   color: white;
   width: 100%;
   height: 150px;
   padding: 15px 10px 15 30;
   
}

/* footer{
  position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
	height: 9%;
   background-color: black;
   color: white;
   text-align: center;
} */ 


</style>