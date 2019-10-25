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