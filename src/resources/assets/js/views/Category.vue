<template>
    <div>
        <v-toolbar flat color="white">
            <v-toolbar-title>Categories</v-toolbar-title>
            <v-divider
                    class="mx-2"
                    inset
                    vertical
            ></v-divider>
            <v-spacer></v-spacer>
            <v-dialog v-model="dialog" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Item</v-btn>
                <v-card>
                    <v-card-title>
                        <span class="headline">{{ formTitle }}</span>
                    </v-card-title>

                    <v-card-text>
                        <v-container grid-list-md>
                            <v-layout wrap>
                                <v-flex xs12 sm12 md12>
                                    <v-text-field v-model="editedItem.title" label="Title"></v-text-field>
                                </v-flex>
                                <v-flex xs12 sm12 md12>
                                    <v-select
                                            item-text  = 'title'
                                            item-value = 'id'
                                            :items="categories"
                                            v-model="editedItem.parent_id"
                                            label="Parent Category"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-select
                                            item-text  = 'name'
                                            item-value = 'value'
                                            :items="itemsSelectMenu"
                                            v-model="editedItem.display_menu"
                                            :label="headers[1].text"
                                    ></v-select>
                                </v-flex>
                                <v-flex xs12 sm6 md6>
                                    <v-select
                                            item-text  = 'name'
                                            item-value = 'value'
                                            :items="itemsSelectStatus"
                                            v-model="editedItem.status"
                                            :label="headers[2].text"
                                    ></v-select>
                                </v-flex>
                               <v-flex xs12 sm12 md12>
                                    <v-text-field v-model="editedItem.slug" label="Slug"></v-text-field>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card-text>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="blue darken-1" flat @click.native="close">Cancel</v-btn>
                        <v-btn color="blue darken-1" flat @click.native="save">Save</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-toolbar>
        <v-data-table
                :headers="headers"
                :items="categories"
                hide-actions
                class="elevation-1"
                disable-initial-sort
        >
            <template slot="items" slot-scope="props">
                <td>{{ props.item.title }}</td>
                <td>{{ display_parent_str(props.item.parent_id) }}</td>
                <td>{{ display_menu_str(props.item.display_menu) }}</td>
                <td>{{ display_status_str(props.item.status) }}</td>
                <td>{{ props.item.slug }}</td>
                <td class="justify-center layout px-0">
                    <v-icon
                            small
                            class="mr-2"
                            @click="editItem(props.item)"
                    >
                        edit
                    </v-icon>
                    <v-icon
                            small
                            @click="deleteItem(props.item)"
                    >
                        delete
                    </v-icon>
                </td>
            </template>
            <template slot="no-data">
                <v-btn color="primary" @click="initialize">Reset</v-btn>
            </template>
        </v-data-table>
    </div>
</template>

<script>
    export default {
        name: "List",
        data: () => ({
            dialog: false,
            categories: [],
            tests: [],
            headers: [
                {
                    text: 'Title',
                    value: 'title'
                },
                {
                    text: 'Parent',
                    value: 'parent'
                },
                {
                    text: 'DisplayMenu',
                    value: 'display_menu'
                },
                {
                    text: 'Status',
                    value: 'status'
                },
                {
                    text: 'Slug',
                    value: 'slug'
                },
                {
                    text: 'Actions',
                    value: 'name',
                    sortable: false
                }
            ],
            itemsSelectMenu: [
                {
                    name:'Inactive',
                    value:0
                },
                {
                    name:'Active',
                    value:1
                }
            ],
            itemsSelectStatus: [
                {
                    name:'Off',
                    value:0
                },
                {
                    name:'On',
                    value:1
                }
            ],
            editedIndex: -1,
            editedItem: {
                title: '',
                parent_id: 0,
                display_menu: 0,
                status: 0,
                slug: '',
            },
            defaultItem: {
                title: '',
                display_menu: 0,
                status: 0,
                slug: '',
            },
            display_menu_select: [
                'Inactive',
                'Active'
            ],
            display_status_select: [
                'Off',
                'On'
            ]
        }),
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
            }
        },
        watch: {
            dialog(val) {
                val || this.close()
            },
            'editedItem.title' :  function(newId) {
                this.editedItem.slug = this.url_slug(newId);
    }
        },

        created() {
            this.initialize()
        },

        methods: {
            initialize() {
                axios
                    .get('/admin/category')
                    .then(response => {
                        this.categories = response.data;
                        this.test = this.formatData(response.data)
                    })
            },
            display_menu_str(val) {
                return val ? this.display_menu_select[1] : this.display_menu_select[0]
            },
            display_status_str(val) {
                return val ? this.display_status_select[1] : this.display_status_select[0]
            },
            display_parent_str(id){
                for (let i=0; i < this.categories.length; i++){
                    if (this.categories[i].id == id) {
                        return this.categories[i].title;
                    }
                }
            },
            editItem(item) {
                this.editedIndex = this.categories.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },

            deleteItem(item) {
                const index = this.categories.indexOf(item)
                if (confirm('Are you sure you want to delete this item?')) {
                    axios.
                        delete(`/admin/category/${item.id}`)
                            .then(response  => {
                                console.log(response.data)
                            });
                    this.categories.splice(index, 1)
                }
            },
            getCategories(current_id = 0) {
                let categories = [{ id: 0, title: '---------'}];
                console.log(this.categories);
                for (let i=0; i < this.categories.length; i++){
                    if (this.categories[i].id == current_id || this.categories[i].parent_id != 0) {
                        continue;
                    }
                    categories.push(this.categories[i]);
                }
                console.log(categories);
                return categories;
            },
            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },

            save() {
                if (this.editedIndex > -1) {
                    axios
                        .put(`/admin/category/${this.editedItem.id}`, { 'data' : this.editedItem })
                        .then( response => {
                            console.log(response.data)
                        });
                    Object.assign(this.categories[this.editedIndex], this.editedItem)
                } else {
                    axios
                            .post(`/admin/category/`, { 'data' : this.editedItem })
                            .then( response => {
                                console.log(response.data)
                            });
                    this.categories.push(this.editedItem)
                }
                this.close()
            },

            formatData(data, depth = 0, parent_id = 0){
                console.log(data);
                let result = [];
                let ths = this;

                data.forEach(function(item, i, arr) {
                    item.level = depth;
                    result.push(item);

                    if(item['parent_id'] == parent_id){
                        ths.formatData(data, depth+1, item['id']).forEach(function(item, i, arr) {
                            result.push(item);
                        });
                    }
                });
                return result;
            },

            url_slug(s, opt) {
                s = String(s);
                opt = Object(opt);

                var defaults = {
                    'delimiter': '-',
                    'limit': undefined,
                    'lowercase': true,
                    'replacements': {},
                    'transliterate': (typeof (XRegExp) === 'undefined') ? true : false
                };

                // Merge options
                for (var k in defaults) {
                    if (!opt.hasOwnProperty(k)) {
                        opt[k] = defaults[k];
                    }
                }

                var char_map = {
                    // Latin
                    'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C',
                    'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I',
                    'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O',
                    'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH',
                    'ß': 'ss',
                    'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c',
                    'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i',
                    'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o',
                    'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th',
                    'ÿ': 'y',

                    // Latin symbols
                    '©': '(c)',

                    // Greek
                    'Α': 'A', 'Β': 'B', 'Γ': 'G', 'Δ': 'D', 'Ε': 'E', 'Ζ': 'Z', 'Η': 'H', 'Θ': '8',
                    'Ι': 'I', 'Κ': 'K', 'Λ': 'L', 'Μ': 'M', 'Ν': 'N', 'Ξ': '3', 'Ο': 'O', 'Π': 'P',
                    'Ρ': 'R', 'Σ': 'S', 'Τ': 'T', 'Υ': 'Y', 'Φ': 'F', 'Χ': 'X', 'Ψ': 'PS', 'Ω': 'W',
                    'Ά': 'A', 'Έ': 'E', 'Ί': 'I', 'Ό': 'O', 'Ύ': 'Y', 'Ή': 'H', 'Ώ': 'W', 'Ϊ': 'I',
                    'Ϋ': 'Y',
                    'α': 'a', 'β': 'b', 'γ': 'g', 'δ': 'd', 'ε': 'e', 'ζ': 'z', 'η': 'h', 'θ': '8',
                    'ι': 'i', 'κ': 'k', 'λ': 'l', 'μ': 'm', 'ν': 'n', 'ξ': '3', 'ο': 'o', 'π': 'p',
                    'ρ': 'r', 'σ': 's', 'τ': 't', 'υ': 'y', 'φ': 'f', 'χ': 'x', 'ψ': 'ps', 'ω': 'w',
                    'ά': 'a', 'έ': 'e', 'ί': 'i', 'ό': 'o', 'ύ': 'y', 'ή': 'h', 'ώ': 'w', 'ς': 's',
                    'ϊ': 'i', 'ΰ': 'y', 'ϋ': 'y', 'ΐ': 'i',

                    // Turkish
                    'Ş': 'S', 'İ': 'I', 'Ç': 'C', 'Ü': 'U', 'Ö': 'O', 'Ğ': 'G',
                    'ş': 's', 'ı': 'i', 'ç': 'c', 'ü': 'u', 'ö': 'o', 'ğ': 'g',

                    // Russian
                    'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
                    'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
                    'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
                    'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
                    'Я': 'Ya',
                    'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
                    'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
                    'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
                    'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
                    'я': 'ya',

                    // Ukrainian
                    'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
                    'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

                    // Czech
                    'Č': 'C', 'Ď': 'D', 'Ě': 'E', 'Ň': 'N', 'Ř': 'R', 'Š': 'S', 'Ť': 'T', 'Ů': 'U',
                    'Ž': 'Z',
                    'č': 'c', 'ď': 'd', 'ě': 'e', 'ň': 'n', 'ř': 'r', 'š': 's', 'ť': 't', 'ů': 'u',
                    'ž': 'z',

                    // Polish
                    'Ą': 'A', 'Ć': 'C', 'Ę': 'e', 'Ł': 'L', 'Ń': 'N', 'Ó': 'o', 'Ś': 'S', 'Ź': 'Z',
                    'Ż': 'Z',
                    'ą': 'a', 'ć': 'c', 'ę': 'e', 'ł': 'l', 'ń': 'n', 'ó': 'o', 'ś': 's', 'ź': 'z',
                    'ż': 'z',

                    // Latvian
                    'Ā': 'A', 'Č': 'C', 'Ē': 'E', 'Ģ': 'G', 'Ī': 'i', 'Ķ': 'k', 'Ļ': 'L', 'Ņ': 'N',
                    'Š': 'S', 'Ū': 'u', 'Ž': 'Z',
                    'ā': 'a', 'č': 'c', 'ē': 'e', 'ģ': 'g', 'ī': 'i', 'ķ': 'k', 'ļ': 'l', 'ņ': 'n',
                    'š': 's', 'ū': 'u', 'ž': 'z'
                };

                // Make custom replacements
                for (var k in opt.replacements) {
                    s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
                }

                // Transliterate characters to ASCII
                if (opt.transliterate) {
                    for (var k in char_map) {
                        s = s.replace(RegExp(k, 'g'), char_map[k]);
                    }
                }

                // Replace non-alphanumeric characters with our delimiter
                var alnum = (typeof (XRegExp) === 'undefined') ? RegExp('[^a-z0-9]+', 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
                s = s.replace(alnum, opt.delimiter);

                // Remove duplicate delimiters
                s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);

                // Truncate slug to max. characters
                s = s.substring(0, opt.limit);

                // Remove delimiter from ends
                s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');

                return opt.lowercase ? s.toLowerCase() : s;
            }
        }
    }
</script>

<style scoped>

</style>