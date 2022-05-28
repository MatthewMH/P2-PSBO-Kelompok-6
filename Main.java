import java.util.Scanner;

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

            }
            else
            {
                System.out.println("Invalid Input!");
                System.out.println("Please Choose 0 or 1!\n");
            }
        }
    }
}