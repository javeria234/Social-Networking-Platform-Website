<template>
    <div class="resetpasswordpage">
     <img :src="'/storage/images/logo.jpg'" alt="logo" class="logo"><br><br>
        <center> <h1> SOCIAL NETWORKING PLATFORM</h1>
        <span class="divider"></span></center><br>

       <center> <form @submit.prevent="submit" class="changepass">
        <jet-validation-errors />
            <div>
        <jet-label for="email" value="Email" class="email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" class="password"/>
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" class="conpassword"/>
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>
<br>
            <div class="resetpasswordbutton">
                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </jet-button>
            </div>
        </form></center>
        </div>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors
        },

        props: {
            email: String,
            token: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    token: this.token,
                    email: this.email,
                    password: '',
                    password_confirmation: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.update'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
<style>
.resetpasswordpage{
    background-image: url('/storage/images/social2.png');
background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
  height:800px;
    }

    .logo {
    width: 85px; 
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
.changepass{
    background-color: black;
    width: 40%;
    box-sizing: border-box;
    max-height: 420px;
    overflow-y: auto;
    font-size: 14px;
    position: center;
    color: black;
    padding: 1rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}
h1{
    font-size: 400%;
    font-weight: bold;
    color: white;
    font-style: OBLIQUE;
    font-family: Noto Sans;
  }
.conpassword{
    color: white;
    float: left;
}
.email{
    color: white;
    float: left;
}
.password{
    color: white;
    float: left;
}
.resetpasswordbutton{
    background-color: black;
color: black;
float: right;
}



</style>