<template>
  <div>
    <h1>Minhas Marcações</h1>
    <ul>
      <li v-for="appointment in appointments" :key="appointment.id">
        {{ appointment.person_name }} - {{ appointment.animal_name }} - {{ appointment.appointment_date }}
        <button @click="editAppointment(appointment)">Editar</button>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      appointments: []
    };
  },
  mounted() {
    this.fetchAppointments();
  },
  methods: {
    async fetchAppointments() {
      const response = await this.$inertia.get('/doctor/appointments');
      this.appointments = response.data;
    },
    editAppointment(appointment) {
      // Lógica para editar agendamento
    }
  }
};
</script>

<style scoped>
/* Adicione seu CSS para melhorias visuais aqui */
h1 {
  color: #2c3e50;
}
button {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 5px;
}
button:hover {
  background-color: #2980b9;
}
</style>
