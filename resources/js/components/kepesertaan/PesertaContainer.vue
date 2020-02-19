<template>
    <div class="animated fadeIn">
        <div class="email-app mb-4">
            <nav>
                <el-row>
                    <el-button size="medium" type="primary" style="width: 100%" plain >Add New</el-button>
                </el-row>
                <br>
                <el-select v-model="value" placeholder="Partner Name">
                    <el-option
                        v-for="item in options"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                    </el-option>
                </el-select>
            </nav>
            <main class="inbox">
                <div class="toolbar">
                    <div class="btn-group">
                        <button class="btn btn-light"><span class="fa fa-pencil"></span></button>
                        <button class="btn btn-light"><span class="fa fa-envelope"></span></button>
                        <button class="btn btn-light"><span class="fa fa-envelope"></span></button>
                        <button class="btn btn-light"><span class="fa fa-envelope"></span></button>
                        <button class="btn btn-light"><span class="fa fa-envelope"></span></button>
                    </div>
                </div>
                <div class="messages">

                </div>
            </main>
        </div>
    </div>
</template>
<script>
export default {
    data() {
      return {
        options: [{
          value: 'Option1',
          label: 'Option1'
        }, {
          value: 'Option2',
          label: 'Option2'
        }, {
          value: 'Option3',
          label: 'Option3'
        }, {
          value: 'Option4',
          label: 'Option4'
        }, {
          value: 'Option5',
          label: 'Option5'
        }],
        value: ''
      }
    }
  }
</script>