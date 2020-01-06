<template>
  <div class="container" onload="window.open('', '_self', '');">
    <el-tabs
      @tab-click="clickTab"
      @tab-remove="removeTab"
      :stretch="true"
      v-model="editableTabsValue"
      tab-position="left"
    >
      <el-tab-pane label="Spotify" name="spotify">
        <iframe
          frameborder="0"
          src="https://open.spotify.com"
          width="100%"
          height="100%"
          allow="geolocation; encrypted-media"
        ></iframe>
      </el-tab-pane>
      <el-tab-pane label="USB" name="usb">USB</el-tab-pane>
      <el-tab-pane label="+Tab" name="addtab"></el-tab-pane>
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
      <el-tab-pane label="Exit" name="turnoff"></el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
import 'element-theme-dark'

export default {
  data() {
    const now = new Date()
    return {
      editableTabsValue: 'spotify',
      editableTabs: [],
      tabIndex: 0,
      nowTime: `${now.getHours()} : ${now.getMinutes()}`
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
      if (targetName.name === 'addtab') {
        this.addTab(targetName)
      }
    }
  }
}
</script>

<style>
.el-tabs__header {
  padding-top: 40px;
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
  width: 100%;
}
.container {
  margin: 0 auto;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: baseline;
  text-align: left;
}

.title {
  font-family: 'Quicksand', 'Source Sans Pro', -apple-system, BlinkMacSystemFont,
    'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  display: block;
  font-weight: 300;
  font-size: 100px;
  color: #35495e;
  letter-spacing: 1px;
}

.subtitle {
  font-weight: 300;
  font-size: 42px;
  color: #526488;
  word-spacing: 5px;
  padding-bottom: 15px;
}

.links {
  padding-top: 15px;
}
</style>
