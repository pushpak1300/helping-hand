<template>
  <div class="card">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0" v-if="isUser">Donation History</h3>
          <h3 class="mb-0" v-else>Redemption History</h3>
        </div>
        <!-- <div class="col text-right">
          <a href="#!" class="btn btn-sm btn-primary">See all</a>
        </div> -->
      </div>
    </div>

    <div class="table-responsive">
      <base-table thead-classes="thead-light"
                  :data="donations">
        <template slot="columns">
          <th v-if="isUser">Donated to</th>
          <th v-else>Redeemed from</th>
          <th>Amount</th>
          <th v-if="isUser">Donated at</th>
          <th v-else>Redeemed at</th>
        </template>

        <template slot-scope="{row}">
          <th scope="row">
            {{row.reciever_id}}
          </th>
          <td>
            {{row.amount}}
          </td>
          <td>
            {{new Date(row.created_at).toString().split('GMT')[0]}}
          </td>
          <!-- <td>
            <i class="fas fa-arrow-up text-success mr-3"
               :class="row.bounceRateDirection === 'up' ? 'text-success': 'text-danger'">
            </i>
            {{row.bounceRate}}
          </td> -->
        </template>

      </base-table>
    </div>

  </div>
</template>
<script>
  export default {
    name: 'page-visits-table',
    props: ['donations'],
    data() {
      return {
        tableData: [
          {
            user: 'Aakash',
            amount: '4,569',
            donated_at: '19 Sept, 2020'
          },
          {
            user: 'Rajesh',
            amount: '2,309',
            donated_at: '31 Oct, 2020'
          },
          {
            user: 'Hritik',
            amount: '190',
            donated_at: '10 August, 2020'
          },
          {
            user: 'Ram',
            amount: '1,200',
            donated_at: '12 Sept, 2020'
          },
          {
            user: 'Ron',
            amount: '1,569',
            donated_at: '28 Nov, 2020'
          }
        ]
      }
    },
    computed: {
        isUser() {
            return localStorage.getItem("role") === "user";
        }
    }
  }
</script>
<style>
</style>
