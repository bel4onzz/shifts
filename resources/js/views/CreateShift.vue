<template>
  <div class="block p-6 rounded-lg bg-white w-4/5 m-auto">
    <h1 class="mb-4">Create Shift</h1>
    <div>
      <div class="form-group mb-6">
        <input
          type="date"
          v-model="request.date"
          class="
            form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          aria-describedby="emailHelp123"
          placeholder="Date"
        />
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-group mb-6">
          <input
            v-model="request.employee"
            type="text"
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            id="exampleInput124"
            placeholder="Employee"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="request.employer"
            type="email"
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            placeholder="Employer"
          />
        </div>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div class="form-group mb-6">
          <input
            v-model="request.hours"
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            id="exampleInput126"
            placeholder="hours"
          />
        </div>
        <div class="form-group mb-6">
          <input
            v-model="request.rate_per_hours"
            class="
              form-control
              block
              w-full
              px-3
              py-1.5
              text-base
              font-normal
              text-gray-700
              bg-white bg-clip-padding
              border border-solid border-gray-300
              rounded
              transition
              ease-in-out
              m-0
              focus:text-gray-700
              focus:bg-white
              focus:border-blue-600
              focus:outline-none
            "
            id="exampleInput126"
            placeholder="Rate per hours"
          />
        </div>
      </div>

      <div class="form-group mb-6">
        <select
          v-model="request.shift_type"
          class="
            form-select
            appearance-none
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding bg-no-repeat
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          aria-label="Default select example"
        >
          <option
            v-for="shift_type in shift_types"
            :key="shift_type.shift_type"
            :value="shift_type.shift_type"
          >
            {{ shift_type.shift_type }}
          </option>
        </select>
      </div>
      <div class="form-group mb-6">
        <input
          v-model="request.taxable"
          class="
            form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          id="exampleInput126"
          placeholder="Taxable"
        />
      </div>
      <div class="form-group mb-6">
        <input
          v-model="request.status"
          class="
            form-control
            block
            w-full
            px-3
            py-1.5
            text-base
            font-normal
            text-gray-700
            bg-white bg-clip-padding
            border border-solid border-gray-300
            rounded
            transition
            ease-in-out
            m-0
            focus:text-gray-700
            focus:bg-white
            focus:border-blue-600
            focus:outline-none
          "
          id="exampleInput126"
          placeholder="Status"
        />
      </div>
      <div class="form-group mb-6">
        <Datepicker v-model="request.paid_at"></Datepicker>
      </div>
      <button
        type="submit"
        @click.prevent="createShift"
        class="
          w-full
          px-6
          py-2.5
          bg-blue-600
          text-white
          font-medium
          text-xs
          leading-tight
          uppercase
          rounded
          shadow-md
          hover:bg-blue-700 hover:shadow-lg
          focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
          active:bg-blue-800 active:shadow-lg
          transition
          duration-150
          ease-in-out
        "
      >
        Create
      </button>
    </div>
  </div>
</template>

<script>
import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

export default {
  components: { Datepicker },
  data() {
    return {
      request: {
        date: null,
        employee: null,
        employer: null,
        hours: null,
        rate_per_hours: null,
        shift_type: null,
        taxable: null,
        status: null,
        paid_at: null,
      },
    };
  },

  methods: {
    getShiftTypes(){},
    getShiftStatuses(){},
    createShift() {
      console.log("HELLOWORLD");
      return axios.post("api/shifts", this.request).then((response) => {
        this.employees = response.data;
        this.loading = false;
      });
    },
  },
};
</script>
