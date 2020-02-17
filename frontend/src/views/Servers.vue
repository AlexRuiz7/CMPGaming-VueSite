<template>
    <!-- MAIN TABLE -->
    <v-data-table dark
      :headers="main_header"
      :items="main_item"
      disable-sort
    >
      <!-- Top slot -->
      <template v-slot:top>
        <v-container>
          <v-row align="center" justify="space-between">
            <v-col cols="4">
              <v-card-title>
                Forgotten Hope 2 Servers by CMP
              </v-card-title>
            </v-col>
            <v-col cols="3">
              <v-switch
                v-model="show_empty"
                label="Show empty servers"
                color="red darken-4"  
              />
            </v-col>
            <v-col cols="4">
              <v-text-field
                prepend-icon="mdi-magnify"
                color="red darken-4"
                v-model="search"
                placeholder="Search..."
                clearable
                single-line
                filled
                dense
                hide-details
              />
            </v-col>
          </v-row>
        </v-container>

        <v-divider/>
      </template>

      <!-- Body slot -->
      <template v-slot:body>
        <v-data-table
          :headers="headers"
          :items="servers2display"
          :search="search"
          :loading="loading"
          :loading-text="loading_msg"
          item-key="gq_hostname"
          hide-default-footer
          show-expand
          must-sort
          sort-by="gq_numplayers"
          sort-desc
          @item-expanded="active($event)"
        >
        <!-- SERVER TABLE -->
        <template v-slot:expanded-item="{ headers, item }">
          <td :colspan="headers.length">
            <v-data-table
              :headers="subheaders"
              :items="item.players"
              :search="search"
              :loading="loading"
              :loading-text="loading_msg"
              item-key="gq_name"
              hide-default-footer
              group-by="team"
              show-group-by
              group-desc
              must-sort
              disable-pagination
            >
            </v-data-table>            
          </td>
        </template>

        <!-- Customization of Server Name row. Join link on click -->
        <template v-slot:item.gq_hostname="{ item }">
          <a :href="item.gq_joinlink"> {{ item.gq_hostname }} </a>
        </template>

        <!-- Customization of Game Type row. Readable text -->
        <template v-slot:item.gq_gametype="{ item }">
          <template v-if="item.gq_gametype === 'gpm_cq'">
            Conquest
          </template>
        </template>

        <!-- Customization of teams naming. Replace team index by team name -->
        <!-- <template v-slot:item.team="{ item, value }">
          <pre> {{ item }} </pre>
        </template> -->

        </v-data-table>
      </template>
    </v-data-table>
</template>


<script>
export default {
  name: "Servers",

  mounted() {
    /* Stablish connection */
    this.socket = new WebSocket(this.host);

    // Add event listener : onOpen
    this.socket.addEventListener("open", () => this.loading = false);

    // Add event listener : onMessage
    this.socket.addEventListener("message", (event) => {
      var data = JSON.parse(event.data);
      var formatted_data = Array();
      for (const key in data) {
        formatted_data.push(data[key])
      }
      this.servers = formatted_data;
    });

    // Add event listener : onClose
    this.socket.addEventListener("close", () => {
      this.loading = true; 
      this.loading_msg = 'Connection with the server has been lost';
    });
  },

  data: () => ({
    /* Main table. 1 column table needed as parent for formatting */
    main_header: [{text: 'ONLINE SERVERS', align: 'center'}],
    main_item: [{}],
    /* Socket vars */
    socket: null,
    host: "ws://127.0.0.1:1942",
    /* State vars */
    loading: true,
    loading_msg: 'Connecting...',
    /* Component data */
    servers: [],
    search: "",
    show_empty: true,
    headers: [
      // {text: 'Join link',         value: 'gq_joinlink'  , align: 'center'},
      {text: 'Server name',       value: 'gq_hostname'  , align: 'center'},
      {text: 'Map name',          value: 'gq_mapname'   , align: 'center'},
      {text: 'GameType',          value: 'gq_gametype'  , align: 'center'},
      {text: 'Players',           value: 'gq_numplayers', align: 'center'},
      {text: 'Max. players',      value: 'gq_maxplayers', align: 'center'},
      {text: 'Map Size',          value: 'bf2_mapsize'  , align: 'center'},
      {text: '', align: 'center', value: 'data-table-expand'},
    ],
    subheaders: [
      {text: 'Player', value: 'gq_name',    align: 'center'},
      {text: 'Score',  value: 'gq_score',   align: 'center'},
      {text: 'Kills',  value: 'skill',      align: 'center'},
      {text: 'Deaths', value: 'gq_deaths',  align: 'center'},
      {text: 'Ping',   value: 'gq_ping',    align: 'center'},
      {text: 'Team',   value: 'team',       align: 'center'},
    ],
    
  }),

  computed: {
    /**
     * Data fields needed:
     *  - gq_hostname
     *  - gq_mapname
     *  - gq_numplayers
     *  - gq_maxplayers
     *  - gq_gametype
     *  - gq_mapsize
     *  - gq_joinlink
     * 
     * IMPORTANT: filter servers by gq_online
     */
    onlineServers() {
      var onlineServers = this.servers.filter(server => server.gq_online);

      this.renameTeams(onlineServers);
      // console.log(JSON.stringify(onlineServers));

      return onlineServers;
    },

    notEmptyServers() {
      return this.onlineServers.filter(server => server.players.length != 0);
    },

    servers2display() {
      return (this.show_empty) ? this.onlineServers : this.notEmptyServers;
    }
  },

  methods: {
    active(event) {
      // console.log(event)
    },

    renameTeams(servers) {
      for(const server of servers) {
        for(var player of server.players)
          player.team = server.teams[2 - player.team].team;
      }
    }
  }
};
</script>
