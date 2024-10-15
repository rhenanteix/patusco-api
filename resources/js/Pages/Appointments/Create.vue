<template>
  <v-container>
    <v-form v-model="valid" @submit.prevent="submitForm">
      <v-text-field
        label="Nome do Cliente"
        v-model="form.person_name"
        :rules="[rules.required]"
        required
      ></v-text-field>

      <v-text-field
        label="Email"
        v-model="form.email"
        :rules="[rules.required, rules.email]"
        required
      ></v-text-field>

      <v-text-field
        label="Nome do Animal"
        v-model="form.animal_name"
        :rules="[rules.required]"
        required
      ></v-text-field>

      <v-select
        label="Tipo de Animal"
        v-model="form.animal_id"
        :items="animals"
        item-text="type"
        item-value="id"
        :rules="[rules.required]"
        required
      ></v-select>

      <v-text-field
        label="Idade do Animal"
        v-model="form.animal_age"
        :rules="[rules.required, rules.age]"
        required
      ></v-text-field>

      <v-textarea
        label="Sintomas"
        v-model="form.symptoms"
        :rules="[rules.required]"
        required
      ></v-textarea>

      <v-date-picker
        label="Data da Consulta"
        v-model="form.appointment_date"
        :rules="[rules.required]"
        required
      ></v-date-picker>

      <v-select
        label="Período"
        v-model="form.appointment_period"
        :items="['morning', 'afternoon']"
        :rules="[rules.required]"
        required
      ></v-select>

      <v-btn type="submit" color="primary">Agendar</v-btn>
    </v-form>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      valid: false,
      form: {
        person_name: "",
        email: "",
        animal_name: "",
        animal_id: null,
        animal_age: null,
        symptoms: "",
        appointment_date: "",
        appointment_period: "",
      },
      animals: [], // Lista de tipos de animais carregados do backend
      rules: {
        required: (value) => !!value || "Campo obrigatório.",
        email: (value) => /.+@.+/.test(value) || "E-mail inválido.",
        age: (value) => (value > 0 && value < 100) || "Idade inválida.",
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post('/appointments', this.form);
        alert('Marcação feita com sucesso!');
      } catch (error) {
        console.error('Erro ao enviar o formulário:', error);
        alert('Erro ao agendar a consulta.');
      }
    },
    async loadAnimals() {
      try {
        const { data } = await axios.get("/api/animals");
        this.animals = data;
      } catch (error) {
        console.error("Erro ao carregar tipos de animais:", error);
      }
    },
  },
  mounted() {
    this.loadAnimals();
  },
};
</script>
