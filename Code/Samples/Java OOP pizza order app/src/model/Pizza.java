package model;

public class Pizza
{
	private int id;
	private String naam;
	private double prijs;

	public Pizza() 
	{
		
	}
	
	public int getId()
	{
		return id;
	}

	public void setId(int id)
	{
		this.id = id;
	}
	
	public String getNaam()
	{
		return naam;
	}

	public void setNaam(String naam)
	{
		this.naam = naam;
	}

	public double getPrijs()
	{
		return prijs;
	}

	public void setPrijs(double prijs)
	{
		this.prijs = prijs;
	}
	
	public String toString() 
	{
		String pizza = naam + " - " + prijs;
		return pizza;
	}
}
