<template>
  <div class="rpi-container">
    <el-tabs
      @tab-click="clickTab"
      @tab-remove="removeTab"
      :stretch="true"
      v-model="editableTabsValue"
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
      <el-tab-pane label="refresh" name="refresh"></el-tab-pane>
      <el-tab-pane label="exit" name="turnoff"></el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
export default {
  data() {
    const now = new Date()
    return {
      volume: 20,
      editableTabsValue: 'spotify',
      editableTabs: [],
      tabIndex: 0,
      nowTime: `${now.getHours()} : ${String(now.getMinutes()).padStart(
        2,
        '0'
      )}`
    }
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
      this.editableTabsValue = newTabName
    },
    removeTab(targetName) {
      this.tabIndex--
      this.editableTabs = this.editableTabs.filter(
        (tab) => tab.name !== targetName
      )
      this.editableTabsValue = 'spotify'
    },
    clickTab(targetName) {
      if (targetName.name === 'turnoff') {
        location.href = 'http://exitkiosk'
      }
      if (targetName.name === 'refresh') {
        this.updateAndRefresh()
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
    },
    decreaseVolume() {
      this.volume -= 10
      if (this.volume < 0) {
        this.volume = 0
      }
    },
    async updateAndRefresh() {
      const response = await this.$axios.$get('http://localhost/update')
      alert(response)
      location.reload()
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
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: initial;
  text-align: center;
  overflow: hidden;
}
</style>
