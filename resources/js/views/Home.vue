<template>
  <div class="relative px-6 lg:px-8">
    <div class="mx-auto pt-20 pb-32 sm:pt-48 sm:pb-40">
      <div>
        <div>
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
          <h1
            class="text-4xl font-bold tracking-tight sm:text-center sm:text-6xl"
          >
            Home Page
          </h1>

          <!-- CREATE SHIFT -->
          <div v-if="!loading" class="flex justify-center">
            <router-link
              class="
                my-2
                inline-block
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
                focus:bg-blue-700
                focus:shadow-lg
                focus:outline-none
                focus:ring-0
                active:bg-blue-800 active:shadow-lg
                transition
                duration-150
                ease-in-out
              "
              to="/create"
              >Create Shift</router-link
            >
          </div>
          <!-- CREATE SHIFT -->
          <div v-if="!loading" class="flex justify-center">
            <h2>OR</h2>
          </div>
          <!-- UPLOAD CSV INPUT -->
          <div class="flex justify-center">
            <div class="mb-3 w-96" v-if="!loading">
              <label
                for="formFileMultiple"
                class="form-label inline-block mb-2 text-gray-700"
                >ImportCSV</label
              >
              <input
                ref="file_input"
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
                type="file"
                id="formFileMultiple"
                multiple
                @change="importData"
              />
            </div>
          </div>
          <!-- UPLOAD CSV INPUT -->

          <!-- TABS SHOW EMPLOYEES OR SHIFTS RESULT -->
          <div>
            <ul
              v-if="employees.length"
              class="
                nav nav-tabs
                flex flex-col
                md:flex-row
                flex-wrap
                list-none
                border-b-0
                pl-0
                mb-4
              "
              id="tabs-tab"
              role="tablist"
            >
              <li class="nav-item" role="presentation">
                <a
                  @click.prevent="show_employees = true"
                  :class="[show_employees ? 'active' : '']"
                  class="
                    nav-link
                    block
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    border-x-0 border-t-0 border-b-2 border-transparent
                    px-6
                    py-3
                    my-2
                    hover:border-transparent hover:bg-gray-100
                    focus:border-transparent
                  "
                  id="tabs-home-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#tabs-home"
                  role="tab"
                  aria-controls="tabs-home"
                  aria-selected="true"
                  >Employees</a
                >
              </li>
              <li class="nav-item" role="presentation">
                <a
                  @click.prevent="show_employees = false"
                  :class="[!show_employees ? 'active' : '']"
                  class="
                    nav-link
                    block
                    font-medium
                    text-xs
                    leading-tight
                    uppercase
                    border-x-0 border-t-0 border-b-2 border-transparent
                    px-6
                    py-3
                    my-2
                    hover:border-transparent hover:bg-gray-100
                    focus:border-transparent
                  "
                  id="tabs-profile-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#tabs-profile"
                  role="tab"
                  aria-controls="tabs-profile"
                  aria-selected="false"
                  >Shifts</a
                >
              </li>
            </ul>
          </div>
          <!-- TABS SHOW EMPLOYEES OR SHIFTS RESULT -->

          <!-- DELETE ALL DATA FROM SHIFTS BUTTON -->
          <div class="flex justify-end mb-4" v-if="employees.length">
            <button
              @click="truncateData"
              type="button"
              data-mdb-ripple="true"
              data-mdb-ripple-color="light"
              class="
                inline-block
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
                focus:bg-blue-700
                focus:shadow-lg
                focus:outline-none
                focus:ring-0
                active:bg-blue-800 active:shadow-lg
                transition
                duration-150
                ease-in-out
              "
            >
              Delete All
            </button>
          </div>
          <!-- DELETE ALL DATA FROM SHIFTS BUTTON -->

          <!-- EMPLOYEES DATA -->
          <div v-if="employees.length && show_employees">
            <h3>Employees</h3>
            <ul
              class="bg-white rounded-lg border border-gray-200 text-gray-900"
            >
              <li
                v-for="employee in employees"
                :key="employee.employee"
                class="
                  inline-grid
                  grid-cols-2
                  px-6
                  py-2
                  border-b border-gray-200
                  w-full
                  rounded-t-lg
                "
              >
                <span class="flex justify-between">
                  <span>{{ employee.employee }}</span>
                </span>
                <span class="flex justify-end">
                  <span>
                    <div class="flex space-x-2 justify-end">
                      <router-link :to="'/employee?name=' + employee.employee"
                        >View</router-link
                      >
                    </div></span
                  >
                </span>
              </li>
            </ul>
          </div>
          <!-- EMPLOYEES DATA -->

          <!-- SHIFTS DATA -->
          <div>
            <div v-if="!show_employees">
              <h3>Shifts | TotalRecords: {{ totalRecords }}</h3>
              <!-- SEARCH INPUT -->
              <div class="flex justify-start">
                <input
                  type="number"
                  v-model="search_total_pay"
                  class="
                    form-control
                    block
                    w-1/2
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
                />
                <button
                  @click="handleSearch"
                  class="
                    inline-block
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
                    focus:bg-blue-700
                    focus:shadow-lg
                    focus:outline-none
                    focus:ring-0
                    active:bg-blue-800 active:shadow-lg
                    transition
                    duration-150
                    ease-in-out
                  "
                >
                  Search
                </button>
              </div>
            </div>
            <!-- SEARCH INPUT -->
            <table v-if="shifts.length && !show_employees" class="w-full">
              <thead class="bg-white border-b">
                <tr>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    #
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Date
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Employee
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Employer
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Hours
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Rate per Hours
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Shift Type
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Taxable
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Status
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Paid At
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  >
                    Total Pay
                  </th>
                  <th
                    scope="col"
                    class="
                      text-sm
                      font-medium
                      text-gray-900
                      px-6
                      py-4
                      text-left
                    "
                  ></th>
                </tr>
              </thead>
              <tbody>
                <tr
                  v-for="(payments, key) in shifts"
                  :key="payments.id"
                  :class="[!(key%2) ? 'bg-gray-100' : '']"
                  class="border-b"
                >
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-sm
                      font-medium
                      text-gray-900
                    "
                  >
                    {{ payments.id }}
                  </td>
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-sm
                      font-medium
                      text-gray-900
                    "
                  >
                    <input
                      type="text"
                      v-model="edit_data.date"
                      v-if="editing[payments.id]"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                    />
                    <span v-else>{{ payments.date }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <input
                      v-if="editing[payments.id]"
                      type="text"
                      v-model="payments.employee"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                    />
                    <span v-else>{{ payments.employee }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <input
                      type="text"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                      v-if="editing[payments.id]"
                      v-model="edit_data.employer"
                    />
                    <span v-else>{{ payments.employer }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <input
                      type="text"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                      v-if="editing[payments.id]"
                      v-model="edit_data.hours"
                    />
                    <span v-else>{{ payments.hours }}</span>
                  </td>
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-sm
                      font-medium
                      text-gray-900
                    "
                  >
                    <input
                      type="text"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                      v-if="editing[payments.id]"
                      v-model="edit_data.rate_per_hours"
                    />
                    <span v-else>{{ payments.rate_per_hours }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <select
                      v-if="editing[payments.id]"
                      v-model="edit_data.shift_type"
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
                        :selected="
                          shift_type.shift_type == payments.shift_type
                            ? true
                            : false
                        "
                      >
                        {{ shift_type.shift_type }}
                      </option>
                    </select>
                    <span v-else>{{ payments.shift_type }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <input
                      type="text"
                      v-if="editing[payments.id]"
                      v-model="edit_data.taxable"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                    />
                    <span v-else>{{ payments.taxable }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <select
                      v-if="editing[payments.id]"
                      v-model="edit_data.status"
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
                        v-for="shift_status in shift_statuses"
                        :key="shift_status.status"
                        :value="shift_status.status"
                        :selected="
                          shift_status.status == payments.status ? true : false
                        "
                      >
                        {{ shift_status.status }}
                      </option>
                    </select>
                    <span v-else>{{ payments.status }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <input
                      type="text"
                      v-if="editing[payments.id]"
                      v-model="edit_data.paid_at"
                      class="
                        form-control
                        block
                        w-full
                        px-2
                        py-1
                        text-sm
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
                    />
                    <span v-else>{{ payments.paid_at }}</span>
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    {{
                      parseFloat(
                        payments.hours * payments.rate_per_hours
                      ).toFixed(2)
                    }}
                  </td>
                  <td
                    class="
                      text-sm text-gray-900
                      font-light
                      px-6
                      py-4
                      whitespace-nowrap
                    "
                  >
                    <i
                      v-if="!editing[payments.id]"
                      @click="getShiftData(payments.id)"
                      class="fa-solid fa-pen-to-square"
                    ></i>
                    <i
                      v-if="!editing[payments.id]"
                      @click="deleteShiftData(payments.id)"
                      class="fa-solid fa-trash ml-4"
                    ></i>
                    <i
                      v-if="editing[payments.id]"
                      @click="updateShiftData(payments.id)"
                      class="fa-solid fa-floppy-disk"
                    ></i>
                    <i
                      v-if="editing[payments.id]"
                      @click="cancelShiftData(payments.id)"
                      class="fa-solid fa-xmark ml-4"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
            <pagination
              v-if="shifts.length && !show_employees"
              class="mt-4"
              :maxVisibleButtons="totalPages >= 5 ? 5 : totalPages"
              :totalPages="totalPages"
              :perPage="perPage"
              :currentPage="currentPage"
              @pagechanged="onPageChange"
            />
          </div>
          <!-- SHIFTS DATA -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Pagination from "./components/Pagination.vue";
export default {
  components: {
    Pagination,
  },
  data() {
    return {
      totalRecords: 0,
      totalPages: 10,
      perPage: 10,
      currentPage: 1,
      search_total_pay: "",
      editing: [],
      edit_data: [],
      loading: false,
      employees: [],
      shifts: [],
      shift: [],
      shift_types: [],
      shift_statuses: [],
      show_employees: true,
    };
  },
  created() {
    console.log("CREATED");
    this.getData();
  },
  methods: {
    onPageChange(page) {
      this.currentPage = page;
      if (page >= 1) {
        return axios
          .get("api/shifts", {
            params: {
              page: this.currentPage,
              size: this.perPage,
              search_query: this.search_total_pay,
            },
          })
          .then((response) => {
            this.employees = response.data.employee;
            this.shifts = response.data.shifts;
            this.totalRecords = response.data.total;
            this.totalPages = Math.ceil(response.data.total / this.perPage);
          });
      }
    },
    handleSearch() {
      return axios
        .get("api/shifts", {
          params: {
            page: 1,
            size: this.perPage,
            search_query: this.search_total_pay,
          },
        })
        .then((response) => {
          this.employees = response.data.employee;
          this.shifts = response.data.shifts;
          this.totalRecords = response.data.total;
          this.totalPages = Math.ceil(response.data.total / this.perPage);
        });
    },
    getData() {
      return axios.get("api/shifts").then((response) => {
        this.employees = response.data.employee;
        this.shifts = response.data.shifts;
        this.totalRecords = response.data.total;
        this.totalPages = Math.ceil(response.data.total / this.perPage);
      });
    },
    getShiftData(shift_id) {
      this.editing = [];
      this.loading = true;
      return axios.get("api/shifts/" + shift_id).then((response) => {
        this.editing[shift_id] = true;
        this.edit_data = response.data.shift;
        this.shift_types = response.data.shift_types;
        this.shift_statuses = response.data.shift_statuses;

        this.loading = false;
      });
    },
    updateShiftData(shift_id) {
      axios.put("api/shifts/" + shift_id, this.edit_data).then(() => {
        this.editing = [];
        this.getData();
      });
    },
    deleteShiftData(shift_id) {
      return axios.delete("api/shifts/" + shift_id).then((response) => {
        this.editing = [];
        this.getData();
      });
    },
    cancelShiftData(shift_id) {
      this.editing.splice(shift_id, 1);
      this.edit_data = [];
      this.shift_types = [];
      this.shift_statuses = [];
    },
    importData(event) {
      this.loading = true;
      let data = new FormData();
      data.append("file", event.target.files[0]);

      let config = {
        header: {
          "Content-Type": "multipart/form-data",
        },
      };

      return axios.post("/upload", data, config).then((response) => {
        this.employees = response.data;
        this.loading = false;
      });
    },
    truncateData(event) {
      return axios.get("api/shifts/truncate").then(() => {
        this.employees = [];
        this.shifts = [];
        this.show_employees = true;
      });
    },
  },
};
</script>

<style>
table input,
select {
  width: 7rem !important;
}
</style>
