<template>
            <img :src="'/storage/images/logo.jpg'" alt="logo" class="logo">
        <center><div class="registerpage">
        <center> <h1> SOCIAL NETWORKING PLATFORM</h1> 
        <span class="divider"></span></center>
                    <br><br>
        <form @submit.prevent="submit" class="registerform">
            <jet-validation-errors class="mb-4" />
            <h2 class="regis">Register Page</h2>
    <p> Please fill in the details below to create an account</p>
            <div>
                <jet-label for="name" value="Name" class="name"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>
<br>
            <div>
                <jet-label for="username" value="Username" class="username" />
                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.username" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" class="email"/>
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" class="password"/>
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="password_confirmation" value="Confirm Password" class="conpassword"/>
                <jet-input id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <jet-label for="gender" value="Gender" class="gender" />
                <select v-model="form.gender" class="block mt-1 w-full border-gray-300 focus: border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option disabled value="">Please select one</option>
                    <option v-bind:value="'Female'">Female</option>
                    <option v-bind:value="'Male'">Male</option>
                </select>
            </div>

            <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div class="flex items-center">
                        <jet-checkbox name="terms" id="terms" v-model="form.terms" />

                        <div class="ml-2">
                            I agree to the <a target="_blank" :href="route('terms.show')" class="underline text-sm text-white-600 hover:text-gray-900">Terms of Service</a> and <a target="_blank" :href="route('policy.show')" class="underline text-sm text-gray-600 hover:text-gray-900">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>
<br>
            
                <inertia-link :href="route('login')" class="account">
                    Already registered?LOG IN
                </inertia-link>
                <jet-button class="registerbutton" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    REGISTER
                </jet-button>
         
        </form>
    </div>
</center>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from "@/Jetstream/Checkbox";
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

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    username: '',
                    gender: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
<style>
.registerpage{
        background-image: url('/storage/images/social2.png');
        background-size: cover;
  background-repeat: no-repeat;
  background-position: center center;
    height: 900px;
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
.account {
    color: white;
    float: left;
    height: 6%;
    font-weight: bold;
    text-decoration: underline;
    font-size: 15px;
    background-color: black;
    margin-left: 14%;
}
  h1{
    font-size: 400%;
    font-weight: bold;
    color: white;
    font-style: OBLIQUE;
    font-family: Noto Sans;
  }
  .registerform{
    background-color: black;
    width: 29%;
    box-sizing: border-box;
    max-height: 700px;
    overflow-y: auto;
    font-size: 14px;
    position: center;
    color: black;
    padding: 1rem;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  }
  .registerbutton {
    font-size: 15px;
    background-color: white;
    color: black;
    float: right;
}
.name{
color: white;
float: left;
}
.username{
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
.conpassword{
color: white;
float: left;
}
.gender{
color: white;
float: left;
}
p{
    color: white;
    font-weight: bold;
  }
  .regis{
    color: white;
    font-weight: bold;
  }

</style>