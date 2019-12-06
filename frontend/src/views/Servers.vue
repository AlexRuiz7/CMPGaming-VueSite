<template>
  <v-container>
    <v-card dark tile>
      <v-card-title>
        Forgotten Hope 2 Servers by CMP
      <v-spacer/>
      <v-text-field
        v-model="search"
        prepend-icon="mdi-magnify"
        label="Search"
        color="red darken-4"
        single-line
        hide-details
      />
      </v-card-title>
    </v-card>

    <v-data-table dark
      :headers="main_header"
      :items="main_item"
      disable-sort
    >
      <template v-slot:body>
        <v-data-table
          :headers="headers"
          :items="onlineServers"
          :search="search"
          :loading="loading"
          :loading-text="loading_msg"
          item-key="gq_hostname"
          hide-default-footer
          show-expand
          @item-expanded="active($event)"
        >
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
            />            
          </td>
        </template>
        </v-data-table>
      </template>
    </v-data-table>
   </v-container>
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
    headers: [
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

    // items: [
    //   {gq_hostname: 'AA1', gq_mapname:'BB1', gq_gametype: 'cq', gq_numplayers: 1, gq_maxplayers: 5, bf2_mapsize: 64},
    //   {gq_hostname: 'AA2', gq_mapname:'BB2', gq_gametype: 'cq', gq_numplayers: 2, gq_maxplayers: 6, bf2_mapsize: 64},
    //   {gq_hostname: 'AA3', gq_mapname:'BB3', gq_gametype: 'cq', gq_numplayers: 3, gq_maxplayers: 7, bf2_mapsize: 64},
    //   {gq_hostname: 'AA4', gq_mapname:'BB4', gq_gametype: 'cq', gq_numplayers: 4, gq_maxplayers: 8, bf2_mapsize: 64}
    // ],
    // players: [
    //   {
    //     "player": "[LP!] RderPSG",
    //     "score": "0",
    //     "ping": "84",
    //     "team": "1",
    //     "deaths": "2",
    //     "pid": "465092323",
    //     "skill": "0",
    //     "AIBot": "0",
    //     "gq_name": "PSG",
    //     "gq_kills": "4",
    //     "gq_deaths": "12",
    //     "gq_ping": "74",
    //     "gq_score": "11"
    //   },
    //   {
    //     "player": "[LP!] R4ydG",
    //     "score": "1",
    //     "ping": "94",
    //     "team": "2",
    //     "deaths": "22",
    //     "pid": "465092323",
    //     "skill": "0",
    //     "AIBot": "0",
    //     "gq_name": " R4yder",
    //     "gq_kills": "7",
    //     "gq_deaths": "20",
    //     "gq_ping": "94",
    //     "gq_score": "1"
    //   },
    //   {
    //     "player": "[LP!]",
    //     "score": "0",
    //     "ping": "80",
    //     "team": "1",
    //     "deaths": "2",
    //     "pid": "465092323",
    //     "skill": "0",
    //     "AIBot": "0",
    //     "gq_name": "[LP!]",
    //     "gq_kills": "3",
    //     "gq_deaths": "5",
    //     "gq_ping": "84",
    //     "gq_score": "27"
    //   }
    // ],
    
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
      return this.servers.filter(server => server.gq_online);
    }
  },

  methods: {
    active(event) {
      // console.log(event)
    }
  }
};
</script>
