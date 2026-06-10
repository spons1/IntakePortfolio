package model;

import java.util.ArrayList;

public class Bestelling
{
	private int klantId;
	private ArrayList<Integer> pizzaId;
	private int bestellingNr;
	
	public Bestelling(int klantId, ArrayList<Integer> pizzaId, int bestellingNr) 
	{
		this.klantId = klantId;
		this.pizzaId = pizzaId;
		this.bestellingNr = bestellingNr;
	}
	
	public int getKlantId()
	{
		return klantId;
	}

	public void setKlantId(int klantId)
	{
		this.klantId = klantId;
	}

	public ArrayList<Integer> getPizzaId()
	{
		return pizzaId;
	}

	public void setPizzaId(ArrayList<Integer> pizzaId)
	{
		this.pizzaId = pizzaId;
	}

	public int getBestellingNr()
	{
		return bestellingNr;
	}

	public void setBestellingNr(int bestellingNr)
	{
		this.bestellingNr = bestellingNr;
	}
	
	public void addPizzaId(int id) 
	{
		pizzaId.add(id);
	}
}
