<template>
  <div class="block p-6 rounded-lg bg-white w-4/5 m-auto">
    <h1 class="mb-4">Create Shift</h1>
    <div v-if="loading" class="flex justify-center items-center">
      <div
        class="
          spinner-border
          animate-spin
          inline-block
          w-8
          h-8
          border-4
          rounded-full
        "
        role="status"
      >
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <div v-else>
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
            v-for="shift_type in types"
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
        <select
          v-model="request.status"
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
            v-for="shift_status in statuses"
            :key="shift_status.status"
            :value="shift_status.status"
          >
            {{ shift_status.status }}
          </option>
        </select>
      </div>
      <div class="form-group mb-6">
        <Datepicker :format="'yyyy-MM-dd hh:mm'" v-model="request.paid_at"></Datepicker>
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
  created() {
    this.getShiftTypes();
    this.getShiftStatuses();
  },
  data() {
    return {
      loading: true,
      statuses: [],
      types: [],
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
    getShiftTypes() {
      return axios.get("api/shift-types", this.request).then((response) => {
        this.types = response.data;
        this.loading = false;
      });
    },
    getShiftStatuses() {
      return axios.get("api/shift-statuses").then((response) => {
        this.statuses = response.data;
        this.loading = false;
      });
    },
    createShift() {
      this.loading = true;
      return axios.post("api/shifts", this.request).then((response) => {
        this.employees = response.data;
        this.loading = false;
      });
    },
  },
};
</script>
