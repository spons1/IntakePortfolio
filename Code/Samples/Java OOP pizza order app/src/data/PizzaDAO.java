package data;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;

import model.Pizza;

public class PizzaDAO
{
	private Database database;
	
	public PizzaDAO() 
	{
		this.database = new Database("localhost", "pizzabestelapp", "root", "");
		database.connect();
	}
	
	public ArrayList<Pizza> getPizzas() 
	{
	       database.connect();

	        String sql = "SELECT * FROM pizza";

	        ResultSet result = database.getData(sql);

	        ArrayList<Pizza> pizzas = new ArrayList<Pizza>();

	        try
	        {
	            while(result.next()) {
	                Pizza pizza = new Pizza();
	                pizza.setId(result.getInt("id"));
	                pizza.setNaam(result.getString("naam"));
	                pizza.setPrijs(result.getDouble("prijs"));
	                pizzas.add(pizza);
	            }
	        } catch (SQLException e)
	        {
	            // TODO Auto-generated catch block
	            e.printStackTrace();
	        }

	        return pizzas;
	    }
	
	public boolean getPizza(int id) 
	{
		database.connect();
		String sql = "SELECT * FROM pizza WHERE id = " + id;
		try 
		{
	        if (database.modifyData(sql) > 0) 
	        {
	            return true;
	        } else 
	        {
	            return false;
	        }
	    } catch (Exception e) 
		{
	        System.err.println(e.getMessage()); 
	    }
	    database.disconnect();
	    return false; 
	}
}
