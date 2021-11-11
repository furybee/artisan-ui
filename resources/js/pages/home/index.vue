<template>
  <div class="py-4">
    <h1 class="font-bold text-2xl mb-4">Artisan Commands</h1>

    <div
      class="sticky flex flex-col shadow rounded-md mt-1 flex items-center mb-4 top-0"
    >
      <input
        type="search"
        placeholder="Search"
        v-model="filter"
        class="w-full px-4 sm:px-6"
      />

      <div v-if="hasVendor === true" class="relative flex items-center">
        <div class="flex items-center h-5">
          <input
            id="custom-only"
            name="custom-only"
            type="checkbox"
            class="focus:blue-900 h-4 w-4 text-blue-900 border-blue-900 rounded"
            v-model="isCustomOnly"
          />
        </div>
        <div class="py-1 px-3 text-sm">
          <label for="custom-only" class="font-medium text-gray-700"
            >Custom Only</label
          >
        </div>
      </div>
    </div>

    <div class="overflow-hidden">
      <ul role="list">
        <li
          v-for="command in filteredCommands"
          :key="command.name"
          class="shadow sm:rounded-md bg-white mb-6"
        >
          <a href="#" class="block hover:bg-gray-50">
            <div class="px-4 py-4 sm:px-6">
              <div class="flex items-center justify-between">
                <p class="text-lg font-bold text-blue-900 truncate">
                  {{ command.name }}
                </p>
                <div
                  v-if="command.is_custom === true"
                  class="ml-2 flex-shrink-0 flex"
                >
                  <p
                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
                  >
                    Custom
                  </p>
                </div>
              </div>
              <p>{{ command.description }}</p>

              <div v-if="command.definition.options.length !== 0" class="mt-3">
                <h3 class="text-sm font-semibold">Options</h3>
                <ul class="list-disc list-inside space-y-1">
                  <li
                    v-for="(option, optionName) in command.definition.options"
                    :key="optionName"
                  >
                    <code class="bg-gray-100 text-sm">{{ optionName }}</code> -
                    {{ option.description }}
                    <span
                      v-if="option.is_value_required === true"
                      class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-800"
                    >
                      Required
                    </span>
                    <span
                      v-else
                      class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-800"
                    >
                      Optional
                    </span>
                  </li>
                </ul>
              </div>

              <div
                v-if="command.definition.arguments.length !== 0"
                class="mt-3"
              >
                <h3 class="text-sm font-semibold">Arguments</h3>
                <ul class="list-disc list-inside space-y-1">
                  <li
                    v-for="(argument, argumentName) in command.definition
                      .arguments"
                    :key="argumentName"
                  >
                    <code class="bg-gray-100 text-sm">{{ argumentName }}</code>
                    -
                    {{ argument.description }}
                    <span
                      v-if="argument.is_required === true"
                      class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-red-100 text-red-800"
                    >
                      Required
                    </span>
                    <span
                      v-else
                      class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-green-100 text-green-800"
                    >
                      Optional
                    </span>
                  </li>
                </ul>
              </div>

              <div
                class="p-4 mt-3 -mx-6 -mb-4 bg-blue-900 text-white block sm:rounded-b-md"
              >
                <pre v-for="(usage, index) in command.usage" :key="index">{{
                  usage
                }}</pre>
              </div>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import collect from "collect.js";

export default {
  data() {
    return {
      commands: [],
      filteredCommands: [],
      filter: "",
      isCustomOnly: true,
      hasVendor: true,
    };
  },
  mounted() {
    this.commands = window.ArtisanUi.commands;

    this.applyFilters();
  },
  methods: {
    applyFilters() {
      this.filteredCommands = collect(this.commands)
        .filter((command) => {
          return (
            command.name.toLowerCase().includes(this.filter) === true ||
            command.description.toLowerCase().includes(this.filter) === true
          );
        })
        .when(this.isCustomOnly === true, (commands) => {
          return commands.filter((command) => {
            return command.is_custom === true;
          });
        })
        .all();
    },
  },
  watch: {
    filter(newValue, oldValue) {
      const filter = newValue.trim().toLowerCase();

      if (filter === "") {
        this.filteredCommands = this.commands;
        return;
      }

      this.applyFilters();
    },
    isCustomOnly(newValue, oldValue) {
      this.applyFilters();
    },
  },
};
</script>
