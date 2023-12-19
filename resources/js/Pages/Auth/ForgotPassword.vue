<template>
    <div class="resetpass">
        <img :src="'/storage/images/logo.jpg'" alt="logo" class="logo"><br><br>
        <center> <h1> SOCIAL NETWORKING PLATFORM</h1>
        <span class="divider"></span></center><br>
       <center>  <div class="pass">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.

            <br><br>
            <form @submit.prevent="submit">
              <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>
                    <jet-label for="email" value="Email" class="Email" />
                    <jet-input id="email" type="email" class="inputemail" v-model="form.email" required autofocus />
                    <br>
                    <div class="resetlink">
                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Email Password Reset Link
                    </jet-button>
                </div>
          </form>
    </div></center>
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
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: ''
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('password.email'))
            }
        }
    }
</script>

<style>
  .resetpass{
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
  .resetlink {
    color: white;
    background-color: black;
    bottom: auto;
    float: right;
    margin-top: 10px;
}
  .pass{
    background-color: black;
    color: white;
    width: 32%;
    font-weight: bold;
    box-sizing: border-box;
    min-height: 245px;
    overflow-y: auto;
        font-size: 16px;
    
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
  .Email{
    color: white;
    font-weight: bolder;
    font-size: 16px;
    float: left;
    
  }
  .inputemail{
    width: 98%;
    color: black;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    box-sizing: border-box;
  }
</style>

