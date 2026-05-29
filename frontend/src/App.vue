<template>
  <div class="contenedor">

    <h1>Calculadora API PHP</h1>

    <input
      v-model="operador1"
      type="text"
      placeholder="Operador 1"
    />

    <input
      v-model="operador2"
      type="text"
      placeholder="Operador 2"
    />

    <select v-model="operacion">

      <option value="suma">
        Suma
      </option>

      <option value="resta">
        Resta
      </option>

      <option value="multiplicacion">
        Multiplicación
      </option>

      <option value="division">
        División
      </option>
      
    </select>

    <button @click="calcular">
      Calcular
    </button>

    <div class="resultado">
      {{ mensaje }}
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'

const operador1 = ref('')
const operador2 = ref('')
const operacion = ref('suma')
const mensaje = ref('')

async function calcular() {

  const datos = new FormData()

  datos.append('operador1', operador1.value)
  datos.append('operador2', operador2.value)
  datos.append('operacion', operacion.value)

  try {

    const respuesta = await fetch(
      'http://localhost:8000/api.php',
      {
        method: 'POST',
        body: datos
      }
    )

    const json = await respuesta.json()

    if (json.ok) {
      mensaje.value =
        'Resultado: ' + json.resultado
    } else {
      mensaje.value =
        'Error: ' + json.error
    }

  } catch {

    mensaje.value =
      'Error al conectar con la API'
  }
}
</script>

<style>

body{
  font-family: Arial;
  background:#f5f5f5;
}

.contenedor{

  width:400px;

  margin:50px auto;

  background:white;

  padding:20px;

  border-radius:10px;

  box-shadow:0 0 10px rgba(0,0,0,.2);
}

input,
select,
button{

  width:100%;

  padding:10px;

  margin-top:10px;
}

.resultado{

  margin-top:20px;

  font-size:20px;

  font-weight:bold;
}
</style>
