<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h5>Property Datatable</h5></div>
                    <div class="card-body">
                        <div class="control">
                            <div class="select m-b-md col-md-3" style="float: right;">
                                <select class="form-control" v-model="length" @change="resetPagination()">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th v-for="column in columns" :key="column.name" class="table-row">
                                            <i @click="sortBy(column.name)" :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc pointer' : 'sorting_desc pointer') : 'sorting pointer'"></i>
                                            {{column.label}}
                                            <div class="mr-3">
                                                <input class="form-control mt-2" type="text" v-model="search[column.name]" v-bind="keyword[column.name]" @keyup="searchFilter(column.name)" :placeholder="'Search in '+column.label">
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="property in properties" :key="property.id">
                                        <td>{{property.title}}</td>
                                        <td>{{property.description}}</td>
                                        <td>{{property.bedroom}}</td>
                                        <td>{{property.bathroom}}</td>
                                        <td>{{property.property_type}}</td>
                                        <td>{{property.status}}</td>
                                        <td>{{property.for_sale}}</td>
                                        <td>{{property.for_rent}}</td>
                                        <td>{{property.project_name}}</td>
                                        <td>{{property.country}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right">
                            <nav class="pagination">
                                <span class="page-stats m-r-5">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
                                <button class="btn btn-sm btn-primary paginate" @click="getProperties(links.first)">First</button>
                                
                                <button v-if="links.prev" class="btn btn-sm btn-primary paginate" @click="getProperties(links.prev)">Prev</button>
                                <button v-else class="btn btn-sm btn-primary paginate" disabled>Prev</button>
                                
                                <div class="paginate-separate">...</div>
                                
                                <button v-if="links.next" class="btn btn-sm btn-primary paginate" @click="getProperties(links.next)">Next</button>
                                <button v-else class="btn btn-sm btn-primary paginate" disabled>Next</button>
                                
                                <button class="btn btn-sm btn-primary paginate" @click="getProperties(links.last)">Last</button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    .pointer {
        cursor:pointer;
    }
    .table-row {
        font-size: 14px;
        position: relative;
    }
</style>

<script>
    export default {
        created() {
            this.getProperties('/api/properties');
        },
        data() {
            let sortOrders = {};
            let search = {};
            let keyword = {};
            let columns = [
                {label: 'Title', name: 'title' },
                {label: 'Description', name: 'description'},
                {label: 'Bedroom', name: 'bedroom'},
                {label: 'Bathroom', name: 'bathroom'},
                {label: 'Property Type', name: 'property_type'},
                {label: 'Status', name: 'status'},
                {label: 'For Sale', name: 'for_sale'},
                {label: 'For Rent', name: 'for_rent'},
                {label: 'Project Name', name: 'project_name'},
                {label: 'Country', name: 'country'},
            ];
            columns.forEach((column) => {
               sortOrders[column.name] = -1;
               search[column.name] = keyword[column.name] = '';
            });
            return {
                links: [],
                properties: [],
                columns: columns,
                sortOrders: sortOrders,
                length: 20,
                search: search,
                keyword: keyword,
                sortKey: '',
                queryParams: {
                    field: '',
                    keyword: '',
                    perPage: 20,
                    sort: 'asc',
                    sortBy: 'title'
                },
                pagination: {
                    page: '1',
                    from: '',
                    to: '',
                    total: '',
                    last_page: '',
                    per_page: 20,
                    path: ''
                }
            }
        },
        methods: {
            getProperties(url) {
                axios.get(url, {params: this.queryParams})
                    .then(response => {
                        this.links = response.data.links;
                        this.properties = response.data.data;
                        this.pagination = response.data.meta;
                        this.queryParams.perPage = response.data.meta.per_page;
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            paginate(properties, length, pageNumber) {
                return properties.slice((pageNumber - 1) * length, pageNumber * length);
            },
            resetPagination() {
                this.pagination.page = 1;
                this.queryParams.perPage = this.pagination.per_page = this.length;
                this.getProperties(this.links.first);
            },
            sortBy(key) {
                this.sortOrders[key] = this.sortOrders[key] * -1;
                this.queryParams.sortBy = this.sortKey = key;
                this.queryParams.sort = (this.sortOrders[key] > 0)? 'asc': 'desc';
                this.resetPagination();
            },
            searchFilter(field) {
                this.queryParams.field = field;
                this.queryParams.keyword = this.search[field];
                this.resetPagination();
            }
        },
        computed: {
            paginatedProperties() {
                return this.paginate(this.properties, this.length, this.pagination.page);
            }
        },
        mounted() {
            //alert('Component mounted');
        }
    }
</script>
