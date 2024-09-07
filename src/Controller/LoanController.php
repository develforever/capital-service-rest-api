<?php

namespace App\Controller;

use \Exception;
use App\Entity\LoanEntity;
use App\DTO\LoanRequestDTO;
use App\Entity\LoanSchedule;
use Doctrine\ORM\EntityManagerInterface;
use OpenApi\Attributes as OA;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use LoanResponse;
use Nelmio\ApiDocBundle\Annotation\Areas;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Areas(['v1'])]
class LoanController extends AbstractFOSRestController
{

    #[Rest\View()]
    #[Rest\Get('/', name: 'v1_index')]
    public function index(Request $request)
    {

        return new JsonResponse(status: Response::HTTP_OK);
    }

    #[Rest\View()]
    #[Rest\Post('/loan', name: 'v1_loan')]
    #[OA\Response(
        response: 200,
        description: 'Successful response',
        content: new Model(type: LoanResponse::class)
    )]
    public function loan(Request $request, #[MapRequestPayload] LoanRequestDTO $loanRequestDTO, EntityManagerInterface $manager): JsonResponse
    {

        $data = [
            'loan' => null
        ];

        $manager->getConnection()->beginTransaction();

        $installments = $loanRequestDTO->installments;
        $amount = $loanRequestDTO->amount * 100;

        try {

            $loan = new LoanEntity();
            $loan->setInstallments($loanRequestDTO->installments);
            $loan->setAmount($loanRequestDTO->amount);
            // todo make configurable eg. .env file or .yaml file ? or maybe from DTO?
            $annualInterest = 7;
            $annualInterestPercent = 7 / 100;
            $loan->setInterest($annualInterest);

            $manager->persist($loan);

            for ($i = 0; $i < $installments; $i++) {


                $r = $amount *
                    (
                        ($annualInterestPercent / 12 * pow((1 + ($annualInterestPercent / 12)), $loanRequestDTO->installments))
                        /
                        (pow(1 + $annualInterestPercent / 12, $loanRequestDTO->installments) - 1)
                    );

                $loanSchedule = new LoanSchedule();
                $fund = round($amount - $r * $i);
                $interest = round($fund * $annualInterestPercent * 31 / 365);
                $loanSchedule
                    ->setLoanId($loan)
                    ->setNr($i + 1)
                    ->setAmount(round($r))
                    ->setInterest($interest)
                    ->setFund($fund);

                $manager->persist($loanSchedule);
            }

            $manager->flush();
            $manager->getConnection()->commit();

            $data['loan'] = $loan;
        } catch (Exception $e) {
            $manager->getConnection()->rollBack();
            throw $e;
        }


        return new JsonResponse(data: $data,  status: Response::HTTP_OK);
    }

    #[Rest\View()]
    #[Rest\Delete('/loan/{id}', name: 'v1_loan_delete')]
    public function loanDelete(
        Request $request,
        LoanEntity $loan,
        EntityManagerInterface $manager
    ) {


        $loan->setDeletedAt(new \DateTime('now'));
        $manager->persist($loan);
        $manager->flush();

        return new JsonResponse(status: Response::HTTP_NO_CONTENT);
    }

    #[Rest\View()]
    #[Rest\Get('/loans', name: 'v1_loan_calculations')]
    public function loanCalculations(Request $request, EntityManagerInterface $manager)
    {

        $loansRepo = $manager->getRepository(LoanEntity::class);
        $loans = $loansRepo->findAllGreaterThanPrice();

        return new JsonResponse(data: $loans, status: Response::HTTP_OK);
    }
}
