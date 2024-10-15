<template>
  <div>
    <h1>Gerenciar Agendamentos</h1>
    <form @submit.prevent="filterAppointments">
      <input type="date" v-model="filter.date" />
      <select v-model="filter.animal_type">
        <option value="">Selecione o tipo de animal</option>
        <option value="cachorro">Cachorro</option>
        <option value="gato">Gato</option>
      </select>
      <button type="submit">Filtrar</button>
    </form>

    <h2>Agendamentos</h2>
    <ul>
      <li v-for="appointment in appointments" :key="appointment.id">
        {{ appointment.person_name }} - {{ appointment.animal_name }} - {{ appointment.appointment_date }}
        <button @click="editAppointment(appointment)">Editar</button>
        <button @click="deleteAppointment(appointment.id)">Excluir</button>
      </li>
    </ul>

    <h2>Criar Agendamento</h2>
    <form @submit.prevent="createAppointment">
      <input v-model="newAppointment.person_name" placeholder="Nome" required />
      <input v-model="newAppointment.animal_name" placeholder="Nome do Animal" required />
      <select v-model="newAppointment.animal_type" required>
        <option value="cachorro">Cachorro</option>
        <option value="gato">Gato</option>
      </select>
      <input v-model="newAppointment.appointment_date" type="date" required />
      <button type="submit">Adicionar Agendamento</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      filter: {
        date: '',
        animal_type: ''
      },
      appointments: [],
      newAppointment: {
        person_name: '',
        animal_name: '',
        animal_type: '',
        appointment_date: ''
      }
    };
  },
  methods: {
    async filterAppointments() {
      // Lógica para filtrar agendamentos
      this.appointments = await this.$inertia.get('/appointments', this.filter);
    },
    async createAppointment() {
      // Lógica para criar um novo agendamento
      await this.$inertia.post('/appointments', this.newAppointment);
      console.log(this.newAppointment, 'Jessie');
      this.newAppointment = {}; // Limpar o formulário
      await this.filterAppointments(); // Atualizar a lista de agendamentos
    },
    async deleteAppointment(id) {
      await this.$inertia.delete(`/appointments/${id}`);
      await this.filterAppointments(); // Atualizar a lista
    },
    editAppointment(appointment) {
      // Lógica para editar agendamento
      this.newAppointment = { ...appointment };
    }
  }
};
</script>

<style scoped>
/* Adicione seu CSS para melhorias visuais aqui */
h1 {
  color: #2c3e50;
}
form {
  margin-bottom: 20px;
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
