package data;

import java.sql.ResultSet;
import java.util.Arrays;
import java.util.List;

import model.Klant;

public class KlantDAO
{
	private Database database;

	public KlantDAO()
	{
		database = new Database("localhost", "pizzabestelapp", "root", "");
		database.connect();
	}

	public int createKlantOUD(Klant klant)
	{
		database.connect();
		String sql = "INSERT INTO klant (naam, adres, mobiel) VALUES('" + klant.getNaam() + "','"
				+ klant.getAdres() + "','" + klant.getMobiel() + "')";
		int result = database.insertData(sql);
		database.disconnect();

		return result;
	}
	
	public int createKlant(Klant klant) 
	{
	    database.connect();
	
	    String sql = "INSERT INTO klant (naam, adres, mobiel) VALUES (?, ?, ?)";
	    List<Object> parameters = Arrays.asList(klant.getNaam(), klant.getAdres(), klant.getMobiel());
	
	    int result = database.insertData(sql, parameters);
	
	    database.disconnect();
	
	    return result;
	}	
}
