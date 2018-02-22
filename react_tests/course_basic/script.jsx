/**
 * Based on React course from Leo Trieu on code4tuts
 */

// Code goes here
// JSX script

//Adding Product Form

var Product = React.createClass({
  getInitialState: function(){
    return {qty:0}; //initial state for buy function
  },
  
  buy: function(){
        //get qty object from state and add 1
    this.setState({qty: this.state.qty + 1 }); 

    this.props.handleTotal(this.props.price);
    
  }, //comma is required since those are methods in a js object
  
  show: function(){
    //will call the method inside handleShow prop 
    //passing the name prop as parameter
    this.props.handleShow(this.props.name);
  },
  

  
  render: function(){
    return (
      //need to put all our stuff in a single element
      <div>
        <p>Here i have {this.props.name} for ${this.props.price}</p>
        <button onClick={this.buy}>Do Stuff</button>
        <button onClick={this.show}>Show</button>
        <h3>done stuff {this.state.qty} times</h3>
        <hr/>
        </div>
      );
  } //end method
  
}); //end React.createClass


var Total = React.createClass({
  render: function(){
    return(
      <div>
      <h3>Stuff provided me:{this.props.total}</h3>
      </div>
      );
  } //end method
  
}); //end React.createClass

//product form
var ProductForm = React.createClass({
  //submit function for button
  submit: function(e){
    e.preventDefault();
   alert('Stuff name: '+this.refs.name.value + ' price: '+this.refs.price.value);

  var product = {
    name:this.refs.name.value, 
    price:parseInt(this.refs.price.value) 
  };
  
  this.props.handleCreate(product);
  
    this.refs.name.value = '';
    this.refs.price.value = '';
  },
  
  //renderer
  render: function(){
    return(
      <form onSubmit={this.submit}>
        <input type="text" placeholder="Insert Stuff" ref="name"/> -
        <input type="text" placeholder="Price of Stuff" ref="price"/>
        <br/><br/>
        <button >Create Stuff</button>
      <hr/>
      </form>
      );
  }
  
}); //end React.createClass


//ProductList is a parent component 
//while Product and Total are child components
var ProductList = React.createClass({
  
  getInitialState: function(){
    
    //now the list of products is defined by an array of objects
    return {
      total: 0,
      productList: [
          {name: 'Single Stuff', price: 14},
          {name: 'Bigger Stuff', price: 20},
          {name: 'Whole Stuff', price: 121}
        ]
    };
  },
  

  createProduct: function(product){
    alert('createProduct invoked - name:' + product.name + ' - price ' + product.price );
    this.setState({
      productList: this.state.productList.concat(product)
      })
  },

  
  calculateTotal: function(price){
    this.setState({total: this.state.total + price});
   // alert(this.state.total);
  },
  
  showProduct: function(name){
    alert("Showing " + name);
    
  },
  
  render: function(){
    var component = this; //needed to overcome the scope problem in products function
    var products = this.state.productList.map(function(product){
      return(
          <Product name={product.name} price={product.price} handleShow={component.showProduct} handleTotal={component.calculateTotal}/>
        );
    });
    //note: to treat a digit like a number use {number}
    return(
      <div>
      <ProductForm handleCreate={this.createProduct} />
      {products}      
      <Total total={this.state.total}/>
      </div>
      );
  } //end method
  
}); //end React.createClass

React.render(<ProductList/>, document.getElementById("root"));
