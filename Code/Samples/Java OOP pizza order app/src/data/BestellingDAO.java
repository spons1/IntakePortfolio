package data;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import model.Klant;
import model.Pizza;

public class BestellingDAO 
{
	private Database database;

	public BestellingDAO() 
	{
		database = new Database("localhost", "pizzabestelapp", "root", "");
		database.connect();  
	}

	public int createBestelling(Klant klant, ArrayList<Pizza> pizzaBestelLijst) 
	{
		String sql = "INSERT INTO bestelling (klantid) VALUES(?)";
		List<Object> parameters = Arrays.asList(klant.getId());
		int bestelNummer = database.insertData(sql, parameters);

		createBestellingDetails(bestelNummer, pizzaBestelLijst);

		return bestelNummer;
	}

	public int createBestellingDetails(int bestelId, ArrayList<Pizza> pizzaBestelLijst) 
	{
		int result = 0;
		for (Pizza pizza : pizzaBestelLijst) {
			String sql = "INSERT INTO bestellingdetails (bestelling_id, pizza, prijs) VALUES (?, ?, ?)";
			List<Object> parameters = Arrays.asList(bestelId, pizza.getNaam(), pizza.getPrijs());
			result = database.insertData(sql, parameters);
		}
		return result;
	}
}
