<template>
  <div class="card">
    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
          <h3 class="mb-0">Donation History</h3>
        </div>
        <!-- <div class="col text-right">
          <a href="#!" class="btn btn-sm btn-primary">See all</a>
        </div> -->
      </div>
    </div>

    <div class="table-responsive">
      <base-table thead-classes="thead-light"
                  :data="tableData">
        <template slot="columns">
          <th>Donated to</th>
          <th>Amount</th>
          <th>Donated at</th>
        </template>

        <template slot-scope="{row}">
          <th scope="row">
            {{row.user}}
          </th>
          <td>
            {{row.amount}}
          </td>
          <td>
            {{row.donated_at}}
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
    }
  }
</script>
<style>
</style>
