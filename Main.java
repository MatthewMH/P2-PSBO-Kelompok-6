import java.util.Scanner;
import java.util.UUID;

public class Main
{
    public static void main(String args[])
    {
        System.out.println("\nWELCOME TO TOKOAPP");
        System.out.println("-------------------------------------");
        System.out.println("-------------------------------------\n");

       while(true)
        {
            System.out.println("If you are a buyer press 0");
            System.out.println("If you are a seller press 1");
            System.out.printf("Choice : ");

            Scanner inp = new Scanner(System.in);
            int choice = inp.nextInt();


            if(choice == 0)
            {
                System.out.println("\nChoose 0 for Login");
                System.out.println("Choose 1 for Sign Up");
                
                System.out.printf("Choice : ");
                int c = inp.nextInt();

                if(c == 0)
                {
                    System.out.println("\n");
                    
                }
                else
                {

                }
            }
            else if(choice == 1)
            {
                Seller seller = new Seller();

                while(true)
                {
                    System.out.println("\nChoose 0 for Login");
                    System.out.println("Choose 1 for Sign Up");
                    System.out.println("Choose 2 for Back");
                    
                    System.out.printf("Choice : ");
                    int c = inp.nextInt();

                    if(c == 0)
                    {
                        System.out.println("\n");
                        String dummy = inp.nextLine();
                        System.out.printf("Username : ");
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        seller.login(username, password);
                    }
                    else if(c == 1)
                    {
                        String uniqueID = UUID.randomUUID().toString();
                        System.out.printf("Name : ");
                        String dummy = inp.nextLine();
                        String nama = inp.nextLine();
                        System.out.printf("Username : ");
                        String username = inp.nextLine();
                        System.out.printf("Password : ");
                        String password = inp.nextLine();
                        System.out.printf("Location : ");
                        String location = inp.nextLine();
                        seller.sign_up(uniqueID, nama, username, password, location, 0);
                    }
                    else if(c == 2)
                    {
                        break;
                    }
                    else
                    {
                        System.out.println("Invalid Input!\n");
                    }
                }
            }
            else
            {
                System.out.println("Invalid Input!");
                System.out.println("Please Choose 0 or 1!\n");
            }
        }
    }
}