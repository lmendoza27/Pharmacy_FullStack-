<template>
     <div class="login-page">
      <transition name="fade">
         <div v-if="!registerActive" class="wallpaper-login"></div>
      </transition>
      <div class="wallpaper-register"></div>
       <div v-if="logeado" class="container">
         
         <div class="row">
            
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
               <div v-if="!registerActive" class="card login" v-bind:class="{ error: emptyFields }">
                  <h1>Inicio de Sesión</h1>
                    <div v-if="errorStr">
    Lo sentimos, ha ocurrido el siguiente error: {{errorStr}}
  </div>
  
  <div v-if="gettingLocation">
    <i>Obteniendo ubicación...</i>
  </div>
  
  <div v-if="location">
   Tu ubicación es - Latitud: {{ location.coords.latitude }} - Longitud: {{ longitud}}
  </div> 

  <div v-if="error" class="horror">
    Credenciales Incorrectas
    </div><br>
                  <form action class="form-group"  @submit.prevent="doLogin">
                     <input v-model="emailLogin"  type="email" class="form-control" placeholder="Email" required>
                     <input v-model="passwordLogin" type="password" class="form-control" placeholder="Password"  autocomplete="on" required>
                    <input type="submit" class="btn btn-primary" >
                     <p>¿No tienes una cuenta? <a href="#" @click="registerActive = !registerActive, emptyFields = false">Próximamente Registro...</a>
                     </p>
                     <p><a href="#">¿Olvidaste tu Contraseña?</a></p>
                  </form>
                   
               </div>

               <div v-else class="card register" v-bind:class="{ error: emptyFields }">
                  <h1>Registro</h1>
                  <form class="form-group">
                     <input v-model="emailReg" type="email" class="form-control" placeholder="Email" required>
                     <input v-model="passwordReg" type="password" class="form-control" placeholder="Password" required>
                     <input v-model="confirmReg" type="password" class="form-control" placeholder="Confirm Password" required>
                   
                     <p>¿Tienes ya una cuenta? <a href="#" @click="registerActive = !registerActive, emptyFields = false">Iniciar Sesión</a>
                     </p>
                  </form>
               </div>
            </div>
         </div>

      </div>

<!------------ LA VISTA UNA VEZ SE INGRESO -------------------->

       <div v-if="ingreso" class="container auth" >
         
         <div class="row">
            
            <div class="col-lg-4 col-md-6 col-sm-8 mx-auto">
               <div v-if="!registerActive" class="card login" v-bind:class="{ error: emptyFields }">
                  <h1>Bienvenido</h1>
                    <div v-if="errorStr">
    Lo sentimos, ha ocurrido el siguiente error: {{errorStr}}
  </div>
  
  <div v-if="gettingLocation">
    <i>Obteniendo ubicación...</i>
  </div>
  
  <div v-if="location">
   Tu ubicación es - Latitud: {{ location.coords.latitude }} - Longitud: {{ location.coords.longitude}}
  </div> 

  <div v-if="error">
    Credenciales Incorrectas
    </div>

<div>   
<br>
<h5>Lista de Farmacias más cercanas</h5>
  <table class="table-responsive table-striped mt-4">
  <thead>
    <tr>
     
      <th scope="col">Nombre</th>
      <th scope="col">Dirección</th>
      <th scope="col">Distancia</th>
    
    </tr>
  </thead>
  <tbody>
    <tr v-for="post in posts" :key="post.id">
      <td scope="row">{{ post.nombre }}</td>
      <td>{{post.dirección }}</td>
      <td>{{ ((post.distancia).toString().substring(0,5)) }}</td>
    </tr>
  </tbody>
</table>
  </div>
<br>
        <input type="button" @click="Logout" class="btn btn-primary" value="Cerrar Sesión">   
               </div>

            </div>
         </div>
      </div>
   </div>
</template>

<script>

import axios from "axios";


const ENDPOINT_PATH = "http://127.0.0.1:8000/api/v1/";


    export default { 
   data() { 
         return {   
      registerActive: false,
      emailLogin: "",
      passwordLogin: "",
      emailReg: "",
      passwordReg: "",
      confirmReg: "",
      emptyFields: false,
      location:null,
      gettingLocation: false,
      errorStr:null,
      error: false,
      logeado: true,
      ingreso: false,
      longitud:null,
         }
   },

   methods: {

        getData() {
        console.log(this.longitud)
      axios.get(ENDPOINT_PATH+'farmacia?lat='+localStorage.getItem("latitud")+"&lon="+localStorage.getItem("longitud")).then(posts=>{
      this.posts = posts.data
        console.log(this.posts);
			});
     
      },
      async doLogin() {

            try{
            const response = await axios.post(ENDPOINT_PATH+'login', { 
               email: this.emailLogin,
               password: this.passwordLogin
            })

            localStorage.setItem('token', response.data.access_token)
            this.error = false
            this.logeado = false 
            this.ingreso = true
           
            this.Me()
            this.getData();      

            }catch(error) {
              localStorage.removeItem('token')
                console.log("Fallo")
                this.error = true 
            }

      },

      async Me() {
        try{
             axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("token");
      const response = await axios.post(ENDPOINT_PATH+'me', {
      });

      console.log(response)
            this.logeado = false 
            this.ingreso = true
        }catch(error){
            this.logeado = true 
            this.ingreso = false
          console.log("Sesion fallida")
        }

      },

      async Logout() {
            axios.defaults.headers.common["Authorization"] =
                "Bearer " + localStorage.getItem("token");
      const response = await axios.post(ENDPOINT_PATH+'logout', {

      });
       localStorage.removeItem('token')
                  this.logeado = true 
            this.ingreso = false

           
      },
      
      doRegister() {
         if (this.emailReg === "" || this.passwordReg === "" || this.confirmReg === "") {
            this.emptyFields = true;
         } else {
            console.log("Hola");
            alert("You are now registered");
         }
      },


   },

   mounted() {
   this.Me()
   this.getData()
   },
  created() {

   this.getData();


    

  },
  beforeCreate() {

    //do we support geolocation
    if(!("geolocation" in navigator)) {
      this.errorStr = 'Geolocation No está disponible.';
      return;
    }

    this.gettingLocation = true;
    
    // get position
    navigator.geolocation.getCurrentPosition(pos => {
      this.gettingLocation = false;
      this.location = pos;
      this.longitud = pos.coords.longitude;
      localStorage.setItem('longitud', pos.coords.longitude)
      localStorage.setItem('latitud', pos.coords.latitude)

      axios.get(ENDPOINT_PATH+'farmacia?lat='+pos.coords.latitude+"&lon="+pos.coords.longitude).then(posts=>{
      this.posts = posts.data
			});
    }, err => {
      this.gettingLocation = false;
      this.errorStr = err.message;
    })

  }

    }
</script>

<style scoped>

.auth {
  width: 3800px;
}

.horror {
  color: red;
  font-weight: bold;
}

p {
  line-height: 1rem;
}

.card {
  padding: 20px;
}

.form-group input {
  margin-bottom: 20px;
}

.login-page {
  align-items: center;
  display: flex;
  height: 100vh;
}
.login-page .wallpaper-login {
  background: url(https://images.pexels.com/photos/32237/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
  background-size: cover;
  height: 100%;
  position: absolute;
  width: 100%;
}
.login-page .fade-enter-active,
.login-page .fade-leave-active {
  transition: opacity 0.5s;
}
.login-page .fade-enter,
.login-page .fade-leave-to {
  opacity: 0;
}
.login-page .wallpaper-register {
  background: url(https://images.pexels.com/photos/533671/pexels-photo-533671.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260) no-repeat center center;
  background-size: cover;
  height: 100%;
  position: absolute;
  width: 100%;
  z-index: -1;
}
.login-page h1 {
  margin-bottom: 1.5rem;
}

.error {
  animation-name: errorShake;
  animation-duration: 0.3s;
}

@keyframes errorShake {
  0% {
    transform: translateX(-25px);
  }
  25% {
    transform: translateX(25px);
  }
  50% {
    transform: translateX(-25px);
  }
  75% {
    transform: translateX(25px);
  }
  100% {
    transform: translateX(0);
  }
}

</style>
