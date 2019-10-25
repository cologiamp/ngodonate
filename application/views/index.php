<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta name="author" content="Ignacio Giampaoli"/>
		<meta name="creator" content="Ignacio Giampaoli"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title><?php echo $title; ?></title>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url(STYLESHEET.'main.css'); ?>">
	</head>
	<body>

	<div id="app">
	    <h1>{{ name }}</h1> 
	    <div class="row">

	    <div class="column" style="background-color:#aaa;">
	      <h2>Make a new Donation</h2>
	      <select v-model="selected">
	        <option v-for="item in ngos" :value="item" :key="item.id">
	          {{ item.name }}
	        </option>
	      </select>
	      <p>
	        Selected NGO: {{ selected.name }}, Id: {{ selected.id }}
	      </p>
	      <input type="hidden" v-model="selected.name" placeholder="Amount to donate" />
	      <input type="number" v-model="input.amount" placeholder="Amount to donate" />
	      <button v-on:click="sendData()">Send</button>
	    </div>
	      
	    <div class="column" style="background-color:#bbb;">

	        <h2>Previous Donated</h2>
	        <ul id="example-1">
	          <li v-for="(item, index) in donations" :key="item.ngoId">
	            {{ showName(index) }}	            
	            <br>
	            Amount Donated: {{ item.amount }}
	            <br>
	          </li>
	        </ul>

	    </div>
	    
	    </div>
	        
	  </div>

	<script src="https://unpkg.com/vue"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<script>
		var app = new Vue({
		el: '#app',
		data () {
	      	return {
		          name: 'Make a donation to our NGOs',
		          input: {
		              ngoId: "",
		              ngoName: "",
		              amount: "",
		          },
		          response: "",
		          ngos: [
		          	{ id: 1, name: "Doctors Without Borders" },
		          	{ id: 2, name: "Habitat For Humanity" },
		          	{ id: 3, name: "UNHCR" }
		          ],
		          donations: [],
		          totalDonations: [],
		          showTotalDonations: [],
		          selected: "",
		      }
	  	},
	  	mounted() {
		    //this.getNGOs();
		    this.getDonations();
	  	},
	  	methods: {
	  	/*
	    getNGOs(){
	      fetch('<?php echo base_url(); ?>countNgos')
	        .then(response => response.json())
	        .then(data => this.ngos = data);
	    },
	    */
	    showName(index){
	    	for(var i=0;i<this.ngos.length;i++){
	    		if(this.ngos[i].id==index+1){
	    			return this.ngos[i].name;
	    		}
	    	}
	    },
	    getDonations(){
	      fetch('<?php echo base_url(); ?>countDonations')
	        .then(response => response.json())
	        .then(data => this.donations = data)
	        .then((data) => {
	            this.donations = data;
	            //this.calcTotalDonations(data);
	          });
	    },
	    sendData() {
	      var data = new FormData();
	      data.append('ngoId', this.selected.id);
	      data.append('ngoName', this.selected.name);
	      data.append('amount', this.input.amount);
	        axios({ 
	          method: "POST",
	          "url": "<?php echo base_url(); ?>insert", 
	          "data": data, 
	          "headers": { 
	            "Content-Type": "application/json" }
	          }).then(result => {
	        	//alert("Donations Successfully made. Thank you for your donation to: "+result.data);
	            this.response = result.data;
	            //alert("Thank you! $"+this.response.amount+" Donated successfully ("+this.response.created+")";
	            alert("Thank you! You have donated: "+this.response.amount+" to: "+this.response.ngoName+" ("+this.response.created+")");
	            this.getDonations();
	        }, error => {
	            console.error(error);
	        });
		    }
		  }

		});
	</script>

	</body>
</html>