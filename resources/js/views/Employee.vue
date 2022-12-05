<template>
  <p>Name: {{ employee.name }}</p>
  <p>Average pay per hour: {{ employee.avg_pay_hour }}</p>
  <p>Average total pay: {{ employee.avg_total_pey }}</p>

  <div v-if="employee.last_completed_payments">
    <div class="flex flex-col">
      <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
          <div class="overflow-hidden">
            <table class="min-w-full">
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
                </tr>
              </thead>
              <tbody>
                <tr v-for="payments in employee.last_completed_payments" :key="payments.id" class="bg-gray-100 border-b">
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
                    {{payments.id}}
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
                    {{payments.date}}
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
                  {{payments.employee}}
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
                  {{payments.employer}}
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
                  {{payments.hours}}
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
                  {{payments.rate_per_hours}}
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
                  {{payments.shift_type}}
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
                  {{payments.taxable}}
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
                  {{payments.status}}
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
                  {{payments.paid_at}}
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employee: {
        name: "",
        avg_pey_hour: 0,
        avg_total_pey: 0,
        last_completed_payments: null,
      },
    };
  },
  created() {
    this.getEmployeeData();
  },
  methods: {
    getEmployeeData() {
      return axios
        .get("api/employee", {
          params: {
            name: this.$route.query.name,
          },
        })
        .then((response) => {
          this.employee = response.data;
        });
    },
  },
};
</script>

<style>
</style>
