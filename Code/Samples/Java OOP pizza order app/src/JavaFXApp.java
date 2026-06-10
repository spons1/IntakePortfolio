import controller.Controller;
import javafx.application.Application;
import javafx.scene.Scene;
import javafx.scene.layout.GridPane;
import javafx.scene.layout.Pane;
import javafx.stage.Stage;

public class JavaFXApp extends Application
{
	@Override
	public void start(Stage primaryStage) 
	{
		GridPane root = new GridPane();
		Scene scene = new Scene(root, 500, 300);
		
		Controller controller = new Controller(root);
		
		primaryStage.setTitle("Pizza");
		primaryStage.setScene(scene);
		primaryStage.show();
	}
	
	public static void main(String[] args) 
	{
		launch(args);
	}
}