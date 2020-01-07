<template>
  <div class="rpi-container">
    <el-tabs
      @tab-click="clickTab"
      @tab-remove="removeTab"
      :stretch="true"
      v-model="activeTab"
      tab-position="left"
    >
      <el-tab-pane label="spotify" name="spotify">
        <iframe
          frameborder="0"
          src="https://open.spotify.com"
          width="100%"
          height="100%"
          allow="geolocation; encrypted-media"
        ></iframe>
      </el-tab-pane>
      <el-tab-pane label="gmaps" name="googlemaps">
        <iframe
          frameborder="0"
          src="https://www.google.pl/maps/"
          width="100%"
          height="100%"
          allow="geolocation; encrypted-media"
        ></iframe>
      </el-tab-pane>
      <el-tab-pane label="+tab" name="addtab"></el-tab-pane>
      <el-tab-pane
        v-for="item in editableTabs"
        :key="item.name"
        :label="item.title"
        :name="item.name"
        :closable="true"
      >
        <div v-html="item.content"></div>
      </el-tab-pane>
      <el-tab-pane :disabled="true" label="" name="spacer"></el-tab-pane>
      <el-tab-pane
        :label="nowTime"
        :disabled="true"
        name="dateTime"
      ></el-tab-pane>
      <el-tab-pane label="refresh" name="refresh">
        <el-row>
          <el-col :span="24"
            ><div v-loading="true" class="fake-container"></div>
          </el-col>
        </el-row>
      </el-tab-pane>
      <el-tab-pane label="exit" name="turnoff"></el-tab-pane>
    </el-tabs>
    <el-slider
      @change="updateVolume"
      v-model="volume"
      class="volume-slider"
      vertical
      height="96vh"
      step="10"
    ></el-slider>
  </div>
</template>

<script>
export default {
  data() {
    const now = new Date()
    return {
      volume: 50,
      activeTab: 'spotify',
      editableTabs: [],
      tabIndex: 0,
      nowTime: `${now.getHours()} : ${String(now.getMinutes()).padStart(
        2,
        '0'
      )}`
    }
  },
  mounted() {
    this.getVolume()
  },
  methods: {
    addTab(targetName) {
      const newTabName = ++this.tabIndex + Math.random()
      this.editableTabs.push({
        title: `Tab ${this.tabIndex}`,
        name: newTabName,
        content: `<iframe
          frameborder="0"
          src="https://google.com"
          width="100%"
          height="100%"
          allow="geolocation; encrypted-media"
        ></iframe>`
      })
      this.activeTab = newTabName
    },
    removeTab(targetName) {
      this.tabIndex--
      this.editableTabs = this.editableTabs.filter(
        (tab) => tab.name !== targetName
      )
      this.activeTab = 'spotify'
    },
    clickTab(targetName) {
      if (targetName.name === 'turnoff') {
        this.$confirm('Are you sure you want to exit?', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'error'
        })
          .then(() => {
            this.exit()
          })
          .catch(() => {
            this.activeTab = 'spotify'
          })
      }
      if (targetName.name === 'refresh') {
        this.$confirm('Are you sure you want to refresh the page?', 'Warning', {
          confirmButtonText: 'OK',
          cancelButtonText: 'Cancel',
          type: 'error'
        })
          .then(() => {
            this.updateAndRefresh()
          })
          .catch(() => {
            this.activeTab = 'spotify'
          })
      }
      if (targetName.name === 'addtab') {
        this.addTab(targetName)
      }
    },
    increaseVolume() {
      this.volume += 10
      if (this.volume > 100) {
        this.volume = 100
      }
      this.updateVolume()
    },
    decreaseVolume() {
      this.volume -= 10
      if (this.volume < 0) {
        this.volume = 0
      }
      this.updateVolume()
    },
    async getVolume() {
      try {
        const response = await this.$axios.$get(
          `http://localhost/php/volume.php`
        )
        this.volume = parseInt(response)
      } catch (error) {
        this.$message.error(`VolumeGet ${error}`)
      }
    },
    async updateVolume() {
      try {
        await this.$axios.$get(
          `http://localhost/php/volume.php?percent=${this.volume}`
        )
      } catch (error) {
        this.$message.error(`Volume ${error}`)
      }
    },
    async updateAndRefresh() {
      try {
        await this.$axios.$get('http://localhost/php/update.php')
      } catch (error) {
        this.$message.error(`Refresh ${error}`)
      }
      location.reload()
    },
    async exit() {
      try {
        await this.$axios.$get('http://localhost/php/exit.php')
      } catch (error) {
        this.$message.error(`Exit ${error}`)
      }
    }
  }
}
</script>

<style>
#tab-turnoff,
#tab-refresh,
#tab-dateTime {
  font-size: 12px;
  text-align: center;
}
.el-tabs--left .el-tabs__item.is-left {
  text-align: center;
}
.el-tabs__header {
  padding-top: 40px;
  padding-right: 0px;
}
.el-tab-pane {
  padding-left: 10px;
}
.rpi-container,
.el-tabs__content,
.el-tab-pane,
iframe {
  min-height: 99vh;
}
.el-tabs {
  background: url(/rpi.png) no-repeat;
  background-size: 28px;
  background-position: 30px 6px;
  width: 100%;
}
.rpi-container {
  margin: 0 auto;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: initial;
  text-align: center;
  overflow: hidden;
}
.fake-container {
  min-height: 99vh;
}
.volume-slider {
  padding-top: 10px;
}
</style>
