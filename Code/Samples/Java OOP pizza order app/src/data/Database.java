package data;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;

public class Database
{
	private String hostName;
	private String databaseName;
	private String username;
	private String password;
	private Connection connection;

	/**
	 * In de constructor worden alle gegevens ingevoerd om verbinding met de
	 * database te maken
	 * 
	 * @param host         waar de databae op draait ("localhost" voor je lokale pc)
	 * @param databaseName naam van de database die je wilt gebruiken
	 * @param username     om in te loggen op de database (default = "root")
	 * @param password     om in te loggen op de database (default = "")
	 */
	public Database(String host, String databaseName, String username, String password)
	{
		super();
		this.hostName = host;
		this.databaseName = databaseName;
		this.username = username;
		this.password = password;
	}

	public void setHost(String hostName)
	{
		this.hostName = hostName;
	}

	public void setDatabaseName(String databaseName)
	{
		this.databaseName = databaseName;
	}

	public void setUsername(String username)
	{
		this.username = username;
	}

	public void setPassword(String password)
	{
		this.password = password;
	}

	/**
	 * connect start een verbinding met de database
	 */
	public void connect()
	{
		try
		{
			String connectionString = "jdbc:mysql://" + hostName + "/" + databaseName + "?user=" + username
					+ "&password=" + password;
			connection = DriverManager.getConnection(connectionString);
		} catch (SQLException e)
		{
			System.out.println("fout niet verbonden");
		}
	}

	/**
	 * Deze methode wordt gebruikt om aanpassingen aan de data uit te voeren op je
	 * database.
	 * 
	 * @param sql De INSERT, UPDATE, of DELETE query die je wilt uitvoeren op de
	 *            database.
	 * @return Als antwoord krijg je een integer die aangeeft hoeveel records er
	 *         zijn gewijzigd, toegevoegd of verwijderd.
	 */
	public int modifyData(String sql)
	{
		return modifyData(sql, null);
	}
	
	public int modifyData(String sql, List<Object> parameters)
	{
	    try (PreparedStatement statement = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) 
	    {
	        // Voeg parameters toe aan het statement
	    	if (parameters != null)
	    	{
		        for (int i = 0; i < parameters.size(); i++) {
		            statement.setObject(i + 1, parameters.get(i));
		        }
	    	}
	
			int result = statement.executeUpdate(sql);
			System.out.println("Query uitgevoerd");
			return result;
		} catch (SQLException e)
		{
			System.out.println(e.getMessage());
			System.exit(0);
		}
		return 0;
	}

	/**
	 * Deze methode wordt gebruikt om gegevens op te halen vanuit de database met een SELECT.
	 * 
	 * @param sql De SELECT query die uitgevoerd moet worden.
	 * @return Het result in de vorm van een ResultSet (of null als er een error is)
	 */
	public ResultSet getData(String sql)
	{
		try
		{
			Statement stmt = connection.createStatement();
			ResultSet result = stmt.executeQuery(sql);
			return result;
		} catch (SQLException e)
		{
			System.out.println(e.getMessage());
			System.exit(0);
		}
		return null;
	}
	

	/**
	 * Sluit de database verbinding weer
	 */
	public void disconnect()
	{
		try
		{
			connection.close();
			connection = null;
		} catch (SQLException e)
		{
			System.out.println(e.getMessage());
			System.exit(0);
		}
	}

	/**
	 * De functie insertData is om een 'INSERT' sql uit te voeren. Deze functie geeft de waarde  
	 * van het ID veld dat is gevuld terug (auto incremental veld)
	 * 
	 * @param sql INSERT sql om uit te voeren
	 * @return waarde van het ID veld dat is toegevoegd
	 */
	public int insertData(String sql)
	{
		return insertData(sql, null);
	}
	
	/**
	 * De functie insertData is om een 'INSERT' sql uit te voeren. Deze functie geeft de waarde  
	 * van het ID dat is gevuld terug (auto incremental veld) - Nu met preparedStatement (SQL injection)
	 * @param sql INSERT sql om uit te voeren
	 * @param parameters een List waar de parameter waarden in staan
	 * @return waarde van het ID veld dat is toegevoegd
	 */

	public int insertData(String sql, List<Object> parameters) 
	{
	    int id = 0;
	    try (PreparedStatement statement = connection.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) 
	    {
	        // Voeg parameters toe aan het statement
	    	if (parameters != null)
	    	{
		        for (int i = 0; i < parameters.size(); i++) 
		        {
		            statement.setObject(i + 1, parameters.get(i));
		        }
	    	}
	
	        int result = statement.executeUpdate();
	        System.out.println("Query uitgevoerd");
	
	        if (result > 0) {
	            try (ResultSet generatedKeys = statement.getGeneratedKeys()) {
	                if (generatedKeys.next()) 
	                {
	                    id = generatedKeys.getInt(1);
	                } else {
	                    throw new SQLException("Creating record failed, no ID obtained.");
	                }
	            }
	        }
	
	    } catch (SQLException e) {
	        System.out.println(e.getMessage());
	        // Gebruik liever geen System.exit(0), dit sluit je hele applicatie
	        throw new RuntimeException("Database insert failed", e);
	    }
	
	    return id;
	}
	
}
